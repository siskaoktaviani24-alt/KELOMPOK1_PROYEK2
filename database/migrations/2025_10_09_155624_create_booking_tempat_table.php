<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('booking_tempat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('no_telepon');
            $table->date('tanggal_reservasi');
            $table->time('waktu_reservasi');
            $table->integer('jumlah_orang');
            $table->enum('status', ['pending', 'dikonfirmasi', 'dibatalkan'])->default('pending');
            $table->string('kode_booking')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_tempat');
    }
};