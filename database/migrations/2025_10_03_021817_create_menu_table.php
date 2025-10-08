<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_menus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('namaMenu');
            $table->decimal('hargaMenu', 10, 2);
            $table->string('kategori');
            $table->integer('stokMenu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}