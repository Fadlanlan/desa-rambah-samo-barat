<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique()->nullable();
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->cascadeOnDelete();
            $table->foreignId('penduduk_id')->constrained('penduduk')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // Operator/admin yang memproses
            $table->json('data_surat')->nullable(); // Dynamic form data
            $table->text('keterangan')->nullable();

            // Status tracking
            $table->enum('status', [
                'draft', 'diajukan', 'diproses', 'ditandatangani',
                'selesai', 'ditolak', 'dibatalkan'
            ])->default('draft');
            $table->text('alasan_penolakan')->nullable();

            // QR & verification
            $table->string('qr_token', 64)->unique()->nullable();
            $table->string('file_pdf')->nullable();

            // Digital signature
            $table->string('ditandatangani_oleh')->nullable();
            $table->timestamp('ditandatangani_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
