<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id(); // Kolom ID (Primary Key)
            $table->string('nama'); // Nama destinasi
            $table->text('deskripsi'); // Deskripsi destinasi
            $table->integer('harga'); // Harga tiket
            $table->string('gambar'); // Path gambar
            $table->string('kategori'); // Kategori destinasi (contoh: alam, kuliner)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destinasi');
    }
}
