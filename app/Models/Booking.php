<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // PASTIKAN BARIS INI ADA
    protected $table = 'booking';

    protected $fillable = [
        'nama_pelanggan',
        'nomor_meja',
        'pesanan',
        'total_harga',
        'metode_bayar',
        'status'
    ];

    protected $casts = [
        'pesanan' => 'array'
    ];


    // Jika perlu relasi dengan menu
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'booking_menu')
                    ->withPivot('jumlah', 'harga')
                    ->withTimestamps();
    }
}