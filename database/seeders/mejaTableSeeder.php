<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MejaTableSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus isi tabel untuk mencegah data dobel
        DB::table('meja')->truncate();

        DB::table('meja')->insert([
            [
                'no_meja'   => 'A1',
                'kapasitas' => 4,
                'status'    => 'tersedia',
                'pesanan'   => null,
                'is_booked' => false,
            ],
            [
                'no_meja'   => 'A2',
                'kapasitas' => 4,
                'status'    => 'dipesan',
                'pesanan'   => json_encode(['Nasi Goreng']),
                'is_booked' => true,
            ],
            [
                'no_meja'   => 'B1',
                'kapasitas' => 2,
                'status'    => 'tersedia',
                'pesanan'   => null,
                'is_booked' => false,
            ],
        ]);
    }
}
