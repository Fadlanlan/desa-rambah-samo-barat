<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wisata', function (Blueprint $blade) {
            $blade->id();
            $blade->uuid('uuid')->unique();
            $blade->string('nama');
            $blade->string('slug')->unique();
            $blade->text('deskripsi')->nullable();
            $blade->string('lokasi')->nullable();
            $blade->string('harga_tiket')->nullable();
            $blade->string('jam_operasional')->nullable();
            $blade->string('kontak')->nullable();
            $blade->string('gambar')->nullable();
            $blade->boolean('is_active')->default(true);
            $blade->timestamps();
            $blade->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};
