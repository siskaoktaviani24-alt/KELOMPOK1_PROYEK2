<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaMenu', 
        'hargaMenu', 
        'kategori', 
        'stokMenu'
    ];

    // Method untuk menampilkan menu
    public function tampilkanMenu()
    {
        return $this->all();
    }

    // Method untuk update menu
    public function updateMenu($data)
    {
        return $this->update($data);
    }

    // Method untuk cek stok
    public function cekStok()
    {
        return $this->stokMenu;
    }

    // Relasi dengan order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}