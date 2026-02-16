<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

echo "Checking columns for 'penduduk'...\n";
if (!Schema::hasColumn('penduduk', 'nik_hash')) {
    echo "Adding nik_hash to penduduk...\n";
    Schema::table('penduduk', function (Blueprint $table) {
        $table->string('nik_hash', 64)->nullable()->after('nik');
        $table->index('nik_hash');
    });
    echo "Added nik_hash.\n";
}
else {
    echo "nik_hash already exists in penduduk.\n";
}

echo "Checking columns for 'keluarga'...\n";
if (!Schema::hasColumn('keluarga', 'no_kk_hash')) {
    echo "Adding no_kk_hash to keluarga...\n";
    Schema::table('keluarga', function (Blueprint $table) {
        $table->string('no_kk_hash', 64)->nullable()->after('no_kk');
        $table->index('no_kk_hash');
    });
    echo "Added no_kk_hash.\n";
}
else {
    echo "no_kk_hash already exists in keluarga.\n";
}

echo "Verification complete.\n";
