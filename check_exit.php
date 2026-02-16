<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;

$nik_hash = Schema::hasColumn('penduduk', 'nik_hash');
$no_kk_hash = Schema::hasColumn('keluarga', 'no_kk_hash');

if ($nik_hash && $no_kk_hash) {
    exit(0);
}
else {
    exit(1);
}
