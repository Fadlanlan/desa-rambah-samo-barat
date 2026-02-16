<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Emergency Schema Fix Started...\n";

try {
    echo "Adding nik_hash to penduduk...\n";
    DB::statement("ALTER TABLE penduduk ADD COLUMN nik_hash VARCHAR(64) NULL");
    DB::statement("CREATE INDEX IF NOT EXISTS penduduk_nik_hash_index ON penduduk(nik_hash)");
    echo "SUCCESS: nik_hash added.\n";
}
catch (\Exception $e) {
    echo "NOTICE: " . $e->getMessage() . "\n";
}

try {
    echo "Adding no_kk_hash to keluarga...\n";
    DB::statement("ALTER TABLE keluarga ADD COLUMN no_kk_hash VARCHAR(64) NULL");
    DB::statement("CREATE INDEX IF NOT EXISTS keluarga_no_kk_hash_index ON keluarga(no_kk_hash)");
    echo "SUCCESS: no_kk_hash added.\n";
}
catch (\Exception $e) {
    echo "NOTICE: " . $e->getMessage() . "\n";
}

echo "Emergency Schema Fix Finished.\n";
