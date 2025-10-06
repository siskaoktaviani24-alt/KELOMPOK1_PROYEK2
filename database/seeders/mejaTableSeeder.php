<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MejaTableSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan tabel dulu biar tidak dobel
        DB::table('meja')->truncate();

        // Insert beberapa meja sekaligus
        DB::table('meja')->insert([
            [
                'status'   => 'kosong',
                'pesanan'  => null,
            ],
            [
                'status'   => 'terisi',
                'pesanan'  => 'Nasi Goreng',
            ],
            [
                'status'   => 'kosong',
                'pesanan'  => null,
            ],
        ]);
    }
}
