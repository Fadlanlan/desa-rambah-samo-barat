<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            if (!Schema::hasColumn('surat', 'keperluan')) {
                $table->text('keperluan')->nullable()->after('keterangan');
            }
            if (!Schema::hasColumn('surat', 'approved_by')) {
                $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete()->after('status');
            }
            if (!Schema::hasColumn('surat', 'rejected_by')) {
                $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete()->after('approved_by');
            }
            if (!Schema::hasColumn('surat', 'tanggal_pengajuan')) {
                $table->timestamp('tanggal_pengajuan')->nullable()->after('rejected_by');
            }
            if (!Schema::hasColumn('surat', 'tanggal_disetujui')) {
                $table->timestamp('tanggal_disetujui')->nullable()->after('tanggal_pengajuan');
            }
            if (!Schema::hasColumn('surat', 'hash_verifikasi')) {
                $table->string('hash_verifikasi', 64)->unique()->nullable()->after('file_pdf');
            }
        });
    }

    public function down(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            $columns = ['keperluan', 'approved_by', 'rejected_by', 'tanggal_pengajuan', 'tanggal_disetujui', 'hash_verifikasi'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('surat', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
