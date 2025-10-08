<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_meja',
        'statusMeja',
        'kapasitas'
    ];

    // Ubah nama kolom jika perlu
    protected $casts = [
        'statusMeja' => 'string'
    ];

    // Method untuk pilih menu
    public function pilihMenu($menuId, $jumlah)
    {
        // Implementasi di controller
    }

    // Method untuk lihat pesanan
    public function lihatPesanan()
    {
        return $this->hasMany(Reservation::class)->with('order');
    }

    // Method untuk hapus pesanan
    public function hapusPesanan($orderId)
    {
        // Implementasi di controller
    }

    // Method untuk masukkan keranjang
    public function masukkanKeranjang($data)
    {
        // Implementasi di controller
    }

    // Method untuk bayar pesanan
    public function bayarPesanan($orderId)
    {
        // Implementasi di controller
    }

    // Relasi dengan reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}