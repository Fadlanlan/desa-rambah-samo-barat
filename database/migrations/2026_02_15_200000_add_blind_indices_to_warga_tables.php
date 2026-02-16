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
        Schema::table('penduduk', function (Blueprint $table) {
            $table->string('nik_hash', 64)->nullable()->after('nik');
            $table->index('nik_hash');
        });

        Schema::table('keluarga', function (Blueprint $table) {
            $table->string('no_kk_hash', 64)->nullable()->after('no_kk');
            $table->index('no_kk_hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropIndex(['nik_hash']);
            $table->dropColumn('nik_hash');
        });

        Schema::table('keluarga', function (Blueprint $table) {
            $table->dropIndex(['no_kk_hash']);
            $table->dropColumn('no_kk_hash');
        });
    }
};
