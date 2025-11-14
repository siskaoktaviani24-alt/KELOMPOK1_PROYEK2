<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'meja';
    
    protected $fillable = [
        'no_meja',
        'kapasitas',
        'status',
        'pesanan',
        'is_booked'
    ];

    protected $casts = [
        'pesanan' => 'array'
    ];
}
