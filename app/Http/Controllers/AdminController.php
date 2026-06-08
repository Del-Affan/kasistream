<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donasi;
use Carbon\Carbon;
use App\Models\Withdraw;

class AdminController extends Controller
{

    public function dashboard()
    {
        $totalUser = User::count();

        $totalStreamer = User::where(
            'is_streamer',
            true
        )->count();

        $totalDonasi = Donasi::sum('nominal');

        $transaksiHariIni = Donasi::whereDate(
            'created_at',
            today()
        )->count();

        $donasiTerbaru = Donasi::with([
            'user',
            'streamer'
        ])
        ->latest()
        ->take(5)
        ->get();

        return view(
            'admin.admin-dashboard',
            compact(
                'totalUser',
                'totalStreamer',
                'totalDonasi',
                'transaksiHariIni',
                'donasiTerbaru'
            )
        );
    }

    public function users()
    {
        $users = User::latest()->paginate(10);

        return view(
            'admin.admin-users',
            compact('users')
        );
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if($user->role == 'admin'){
            return back()->with(
                'error',
                'Admin tidak bisa dihapus.'
            );
        }

        $user->delete();

        return back()->with(
            'success',
            'User berhasil dihapus.'
        );
    }

    public function streamers()
{
    $streamers = User::where('is_streamer', true)
        ->latest()
        ->paginate(10);

    return view(
        'admin.admin-streamers',
        compact('streamers')
    );
}

    public function removeStreamer($id)
{
    $user = User::findOrFail($id);

    $user->is_streamer = false;

    $user->bio = null;
    $user->game = null;

    $user->instagram = null;
    $user->youtube = null;
    $user->tiktok = null;
    $user->discord = null;

    $user->save();

    return back()->with(
        'success',
        'Status streamer berhasil dicabut.'
    );
}
    public function donations()
    {
        $donasi = Donasi::with([
            'user',
            'streamer'
        ])
        ->latest()
        ->paginate(15);

        return view(
            'admin.admin-donations',
            compact('donasi')
        );
    }

    public function withdraws()
    {
        $withdraws = Withdraw::with('user')
                        ->latest()
                        ->paginate(10);

        return view(
            'admin.admin-withdraws',
            compact('withdraws')
        );
    }

    public function approveWithdraw($id)
    {
        $withdraw = Withdraw::findOrFail($id);

        if($withdraw->status != 'pending')
        {
            return back();
        }

        $user = $withdraw->user;

        $user->balance -= $withdraw->nominal;

        $user->save();

        $withdraw->status = 'approved';

        $withdraw->save();

        return back()->with(
            'success',
            'Withdraw berhasil disetujui.'
        );
    }

    public function rejectWithdraw($id)
    {
        $withdraw = Withdraw::findOrFail($id);

        $withdraw->status = 'rejected';

        $withdraw->save();

        return back()->with(
            'success',
            'Withdraw ditolak.'
        );
    }

    public function reports()
    {
        $totalUser = User::count();

        $totalStreamer = User::where(
            'is_streamer',
            true
        )->count();

        $totalDonasi = Donasi::sum(
            'nominal'
        );

        $totalWithdraw = Withdraw::where(
            'status',
            'approved'
        )->sum(
            'nominal'
        );

        $totalTransaksi = Donasi::count();

        $topStreamer = User::where(
            'is_streamer',
            true
        )
        ->orderByDesc(
            'total_donasi'
        )
        ->take(5)
        ->get();

        return view(
            'admin.admin-reports',
            compact(
                'totalUser',
                'totalStreamer',
                'totalDonasi',
                'totalWithdraw',
                'totalTransaksi',
                'topStreamer'
            )
        );
    }

}