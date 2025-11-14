<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('meja', function (Blueprint $table) {
            $table->id();
            $table->string('no_meja');       // nomor meja
            $table->integer('kapasitas');    // jumlah kapasitas
            $table->enum('status', ['tersedia', 'dipesan'])->default('tersedia');
            $table->json('pesanan')->nullable(); // opsional
            $table->boolean('is_booked')->default(false); // warna seat
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meja');
    }
};
