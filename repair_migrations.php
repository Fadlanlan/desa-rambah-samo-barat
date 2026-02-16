<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Repairing migrations table...\n";

$migrationsToMark = [
    '2026_02_14_100018_create_wisata_table',
    // Add others if needed
];

foreach ($migrationsToMark as $m) {
    $exists = DB::table('migrations')->where('migration', $m)->exists();
    if (!$exists) {
        DB::table('migrations')->insert([
            'migration' => $m,
            'batch' => 1 // Or current batch
        ]);
        echo "Marked $m as migrated.\n";
    }
    else {
        echo "$m already in migrations table.\n";
    }
}

echo "Repair complete.\n";
