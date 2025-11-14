<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('menu')->insert([
            [
                'nama_menu' => 'Espresso',
                'harga' => 15000,
                'stok' => 50,
                'deskripsi' => 'Kopi murni tanpa gula',
                'kategori' => 'Kopi',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Cappuccino',
                'harga' => 20000,
                'stok' => 30,
                'deskripsi' => 'Espresso dengan steamed milk',
                'kategori' => 'Kopi',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Latte',
                'harga' => 22000,
                'stok' => 25,
                'deskripsi' => 'Espresso dengan banyak steamed milk',
                'kategori' => 'Kopi',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Croissant',
                'harga' => 12000,
                'stok' => 20,
                'deskripsi' => 'Pastry Prancis yang renyah',
                'kategori' => 'Makanan',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Sandwich',
                'harga' => 18000,
                'stok' => 15,
                'deskripsi' => 'Roti isi sayuran dan daging',
                'kategori' => 'Makanan',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Teh Tarik',
                'harga' => 10000,
                'stok' => 40,
                'deskripsi' => 'Teh susu khas Malaysia',
                'kategori' => 'Non-Kopi',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}