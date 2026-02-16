<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nomor_antrian', 20);
            $table->string('nama_pengunjung');
            $table->string('nik_pengunjung', 16)->nullable();
            $table->foreignId('penduduk_id')->nullable()->constrained('penduduk')->nullOnDelete();
            $table->string('kontak_pengunjung', 20)->nullable();
            $table->string('keperluan');
            $table->date('tanggal_kunjungan');
            $table->string('jam_kunjungan', 10); // Format: 08:00
            $table->enum('status', ['menunggu', 'dipanggil', 'selesai', 'batal'])->default('menunggu');
            $table->string('token_akses', 40)->unique();
            $table->text('catatan')->nullable();
            $table->foreignId('called_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('called_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['tanggal_kunjungan', 'status']);
            $table->index('nomor_antrian');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrian');
    }
};
