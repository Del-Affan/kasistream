<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonasiController extends Controller
{
    public function create($id)
    {
        $streamer = User::findOrFail($id);

        return view(
            'donasi',
            compact('streamer')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'streamer_id' => 'required|exists:users,id',

            'nominal' => 'required|numeric|min:1000',

            'pesan' => 'nullable|max:150',

            'guest_name' => 'nullable|max:100'

        ]);

        /*
        |--------------------------------------------------------------------------
        | HITUNG FITUR & TOTAL
        |--------------------------------------------------------------------------
        */

        $fiturTotal = array_sum(
    $request->fitur ?? []
);

$adminFee = (int)
    ($request->admin_fee ?? 1500);

$grandTotal = (int)
    ($request->grand_total ?? (
        $request->nominal +
        $fiturTotal +
        $adminFee
    ));
        /*
        |--------------------------------------------------------------------------
        | CEK SALDO USER LOGIN
        |--------------------------------------------------------------------------
        */

        if (
        Auth::check() &&
        strtolower($request->metode) != 'qris'
    ) {

        $user = Auth::user();

        if ($grandTotal > $user->balance) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Saldo wallet tidak mencukupi.'
                );
        }
    }

        $donasi = null;

        try {

            DB::transaction(function () use (
                $request,
                &$donasi,
                $fiturTotal,
                $adminFee,
                $grandTotal
            ) {

                /*
                |--------------------------------------------------------------------------
                | SIMPAN DONASI
                |--------------------------------------------------------------------------
                */

                $donasi = Donasi::create([

                    'user_id' => Auth::check()
                        ? Auth::id()
                        : null,

                    'guest_name' => $request->guest_name,

                    'streamer_id' => $request->streamer_id,

                    'nominal' => $request->nominal,

                    'fitur_total' => $fiturTotal,

                    'admin_fee' => $adminFee,

                    'grand_total' => $grandTotal,

                    'payment_method' => 'wallet',

                    'pesan' => $request->pesan,

                    'status' => strtolower($request->metode) == 'qris'
                    ? 'pending'
                    : 'success'

                ]);

                /*
                |--------------------------------------------------------------------------
                | KURANGI SALDO DONATUR
                |--------------------------------------------------------------------------
                */

                if (
                    Auth::check() &&
                    strtolower($request->metode) != 'qris'
                ) {

                    $user = User::find(Auth::id());

                    $user->balance -= $grandTotal;

                    $user->save();
                }

                /*
                |--------------------------------------------------------------------------
                | TAMBAH SALDO STREAMER
                |--------------------------------------------------------------------------
                */

                $streamer = User::findOrFail(
                    $request->streamer_id
                );

                if(
                    strtolower($request->metode)
                    != 'qris'
                )
                {
                    $streamer->balance += $request->nominal;

                    $streamer->total_donasi += $request->nominal;

                    $streamer->save();
}
            });

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan saat memproses donasi.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT KE HALAMAN SUKSES
        |--------------------------------------------------------------------------
        */

if(strtolower($request->metode) == 'qris')
{
    $invoice = 'DONASI-' . $donasi->id . '-' . time();

    $amount = $grandTotal;

    $url =
        "https://qris.interactive.co.id/restapi/qris/show_qris.php" .
        "?do=create-invoice" .
        "&apikey=" . env('ONOPAY_API_KEY') .
        "&mID=" . env('ONOPAY_MID') .
        "&cliTrxNumber=" . $invoice .
        "&cliTrxAmount=" . $amount .
        "&useTip=no";

    $response =
        file_get_contents($url);

    $result =
        json_decode(
            $response,
            true
        );

    if(
        isset(
            $result['qris_content']
        )
    )
    {
        $donasi->update([

            'invoice_id' =>
                $result['qris_invoiceid'],

            'qris_content' =>
                $result['qris_content']

        ]);
    }

    return redirect()->route(
        'payment.qr',
        $donasi->id
    );
}

return redirect()->route(
    'payment.success',
    $donasi->id
);
    }

    public function history()
    {
        $donasi = Donasi::with('streamer')
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->paginate(10);

        return view(
            'riwayat-donasi',
            compact('donasi')
        );
    }

    public function paymentSuccess($id)
    {
        $donasi = Donasi::with([
            'streamer',
            'user'
        ])->findOrFail($id);

        return view(
            'payment-success',
            compact('donasi')
        );
    }

public function qrPayment($id)
{
    $donasi = Donasi::with([
        'streamer',
        'user'
    ])->findOrFail($id);

    $qrImage = null;

    if($donasi->qris_content)
    {
        $qrImage =
            "https://quickchart.io/qr?text="
            . urlencode(
                $donasi->qris_content
            );
    }

    return view(
        'payment-qr',
        compact(
            'donasi',
            'qrImage'
        )
    );
}

public function checkPayment($id)
{
    $donasi =
        Donasi::findOrFail($id);

    if(!$donasi->invoice_id)
    {
        return back()->with(
            'error',
            'Invoice QRIS tidak ditemukan'
        );
    }

    $url =
        "https://qris.interactive.co.id/restapi/qris/checkpaid_qris.php" .
        "?apikey=" . env('ONOPAY_API_KEY') .
        "&mID=" . env('ONOPAY_MID') .
        "&invoiceid=" .
        $donasi->invoice_id;

    $response =
        file_get_contents($url);

    $result =
        json_decode(
            $response,
            true
        );

    if(
        isset($result['status']) &&
        strtolower(
            $result['status']
        ) == 'paid'
    )
    {
        $donasi->update([
            'status' => 'success'
        ]);

        $streamer =
            User::find(
                $donasi->streamer_id
            );

        $streamer->balance +=
            $donasi->nominal;

        $streamer->total_donasi +=
            $donasi->nominal;

        $streamer->save();

        return redirect()->route(
            'payment.success',
            $donasi->id
        );
    }

    return back()->with(
        'error',
        'Pembayaran belum diterima'
    );
}

public function simulateQris($id)
{
    $donasi = Donasi::findOrFail($id);

    if($donasi->status == 'pending')
    {
        $donasi->update([
            'status' => 'success'
        ]);

        $streamer = User::find(
            $donasi->streamer_id
        );

        $streamer->balance +=
            $donasi->nominal;

        $streamer->total_donasi +=
            $donasi->nominal;

        $streamer->save();
    }

    return redirect()->route(
        'payment.success',
        $donasi->id
    );
}
}