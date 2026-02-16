<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket', 20)->unique();
            $table->foreignId('penduduk_id')->nullable()->constrained('penduduk')->nullOnDelete();
            $table->string('nama_pelapor');
            $table->string('kontak_pelapor')->nullable();
            $table->string('kategori', 50);
            $table->string('judul');
            $table->longText('isi');
            $table->string('bukti')->nullable(); // File upload path
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi', 'urgent'])->default('sedang');
            $table->enum('status', [
                'baru', 'diterima', 'diproses', 'selesai', 'ditolak'
            ])->default('baru');
            $table->longText('balasan')->nullable();
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('prioritas');
            $table->index('kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
