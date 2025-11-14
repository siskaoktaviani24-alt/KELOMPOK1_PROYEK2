<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    
    protected $fillable = [
        'nama_menu',
        'harga',
        'stok',
        'deskripsi',
        'kategori',
        'gambar'
    ];

    protected $casts = [
        'harga' => 'integer',
        'stok' => 'integer'
    ];

    // Accessor untuk URL gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            // Cek jika file exists di storage
            if (file_exists(storage_path('app/public/' . $this->gambar))) {
                return asset('storage/' . $this->gambar);
            }
        }
        return 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80';
    }

    // Scope untuk menu tersedia
    public function scopeAvailable($query)
    {
        return $query->where('stok', '>', 0);
    }
}