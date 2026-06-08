<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $fillable = [

    'user_id',
    'streamer_id',
    'nominal',
    'pesan',
    'status',
    'guest_name',

    'fitur_total',
    'admin_fee',
    'grand_total',
    'payment_method'

];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function streamer()
    {
        return $this->belongsTo(User::class, 'streamer_id');
    }

    public function getNamaDonaturAttribute()
{
    return optional($this->user)->name
           ?? $this->guest_name
           ?? 'Guest';
}
}