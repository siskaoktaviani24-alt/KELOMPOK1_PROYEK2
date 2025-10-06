<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Kalau mau seeder lain, panggil di sini
        $this->call([
            AdminTableSeeder::class,
            MejaTableSeeder::class,
            MenuTableSeeder::class
        ]);
    }
}
