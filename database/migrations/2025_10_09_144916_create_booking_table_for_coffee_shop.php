<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('nomor_meja')->unique();
            $table->json('pesanan');
            $table->integer('total_harga');
            $table->enum('metode_bayar', ['cash', 'dana'])->default('cash');
            $table->enum('status', ['pending', 'selesai', 'dibatalkan'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking');
    }
};