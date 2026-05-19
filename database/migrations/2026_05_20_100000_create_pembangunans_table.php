<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembangunans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('tahun');
            $table->string('kategori');
            $table->string('lokasi')->nullable();
            $table->decimal('anggaran', 15, 2)->default(0);
            $table->decimal('realisasi', 15, 2)->default(0);
            $table->string('pj')->nullable(); // Penanggung Jawab
            $table->string('status')->default('Perencanaan'); // Perencanaan, Berjalan, Selesai
            $table->integer('progress')->default(0); // 0-100
            $table->string('sumber_dana')->nullable();
            $table->string('lat_long')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto_sebelum')->nullable();
            $table->string('foto_sesudah')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembangunans');
    }
};
