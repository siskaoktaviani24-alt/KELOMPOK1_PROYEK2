<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dulu
        DB::table('menu')->truncate();

        // Insert beberapa data menu
        DB::table('menu')->insert([
            [
                'namaMenu'  => 'Nasi Goreng',
                'hargaMenu' => 20000,
                'kategori'  => 'Makanan',
                'stokMenu'  => 15,
            ],
            [
                'namaMenu'  => 'Mie Ayam',
                'hargaMenu' => 15000,
                'kategori'  => 'Makanan',
                'stokMenu'  => 20,
            ],
            [
                'namaMenu'  => 'Es Teh Manis',
                'hargaMenu' => 5000,
                'kategori'  => 'Minuman',
                'stokMenu'  => 30,
            ],
            [
                'namaMenu'  => 'Jus Alpukat',
                'hargaMenu' => 12000,
                'kategori'  => 'Minuman',
                'stokMenu'  => 10,
            ],
        ]);
    }
}
