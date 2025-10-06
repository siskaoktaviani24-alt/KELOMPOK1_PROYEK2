<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
   public function run(): void
{
    \DB::table('admin')->updateOrInsert(
        ['id_admin' => 12345678], // kondisi pencarian
        [
            'username'   => 'admin',
            'password'   => bcrypt('adminpass123'),
            'nama_admin' => 'Deni Purnama',
        ]
    );
}
}
