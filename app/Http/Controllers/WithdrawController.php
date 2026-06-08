<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function create()
    {
        return view('withdraw');
    }

    public function store(Request $request)
    {
        $request->validate(
        [
            'nominal' => 'required|numeric|min:10000',
            'bank' => 'required',
            'rekening' => 'required',
            'nama_rekening' => 'required'
        ],
        [
            'nominal.min' => 'Minimal withdraw adalah Rp 10.000.',
            'nominal.required' => 'Nominal withdraw wajib diisi.'
        ]);

        $user = Auth::user();

        if($request->nominal > $user->balance)
        {
            return back()->with(
                'error',
                'Saldo tidak mencukupi.'
            );
        }

        Withdraw::create([
            'user_id' => $user->id,
            'nominal' => $request->nominal,
            'bank' => $request->bank,
            'rekening' => $request->rekening,
            'nama_rekening' => $request->nama_rekening,
            'status' => 'pending'
        ]);

        return redirect('/wallet')
        ->with(
            'success',
            'Permintaan withdraw berhasil dikirim.'
        );
    }
}