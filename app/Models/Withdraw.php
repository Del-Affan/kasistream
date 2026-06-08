<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'user_id',
        'nominal',
        'bank',
        'rekening',
        'nama_rekening',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}