<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_mejas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMejasTable extends Migration
{
    public function up()
    {
        Schema::create('mejas', function (Blueprint $table) {
            $table->id();
            $table->string('no_meja')->unique();
            $table->enum('statusMeja', ['tersedia', 'terpakai', 'reserved'])->default('tersedia');
            $table->integer('kapasitas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mejas');
    }
}