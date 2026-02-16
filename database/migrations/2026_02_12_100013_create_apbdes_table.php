<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('apbdes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->year('tahun_anggaran');
            $table->enum('jenis', ['pendapatan', 'belanja', 'pembiayaan']);
            $table->string('kategori')->nullable();
            $table->string('sub_kategori')->nullable();
            $table->string('uraian');
            $table->decimal('anggaran', 15, 2)->default(0);
            $table->decimal('realisasi', 15, 2)->default(0);
            $table->string('sumber_dana')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index('tahun_anggaran');
            $table->index('jenis');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apbdes');
    }
};
