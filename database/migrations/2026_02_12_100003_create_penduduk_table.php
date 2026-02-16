<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_id')->nullable()->constrained('keluarga')->nullOnDelete();
            $table->text('nik'); // Encrypted
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama', 30)->nullable();
            $table->string('status_perkawinan', 30)->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('kewarganegaraan', 5)->default('WNI');
            $table->text('alamat')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('dusun')->nullable();
            $table->string('golongan_darah', 5)->nullable();
            $table->string('no_hp', 20)->nullable(); // May be encrypted
            $table->string('foto')->nullable();
            $table->enum('status_hubungan', [
                'Kepala Keluarga', 'Istri', 'Anak', 'Menantu', 'Cucu',
                'Orang Tua', 'Mertua', 'Famili Lain', 'Pembantu', 'Lainnya'
            ])->nullable();
            $table->enum('status', ['aktif', 'meninggal', 'pindah', 'hilang'])->default('aktif');
            $table->text('catatan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index('nama');
            $table->index('jenis_kelamin');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
