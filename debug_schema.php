<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

$output = "--- Debug Schema Check ---\n";

$columns = Schema::getColumnListing('penduduk');
$output .= "Columns in 'penduduk': " . implode(', ', $columns) . "\n\n";

if (in_array('nik_hash', $columns)) {
    $output .= "RESULT: nik_hash EXISTS\n";
}
else {
    $output .= "RESULT: nik_hash MISSING\n";
}

$output .= "\n--- Migrations Table ---\n";
try {
    $migrations = DB::table('migrations')->get();
    foreach ($migrations as $m) {
        $output .= "Migration: " . $m->migration . " (Batch: " . $m->batch . ")\n";
    }
}
catch (\Exception $e) {
    $output .= "Error reading migrations table: " . $e->getMessage() . "\n";
}

file_put_contents('debug_schema_results.txt', $output);
echo "Debug complete. Results in debug_schema_results.txt\n";
