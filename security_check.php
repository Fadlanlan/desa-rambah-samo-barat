<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

$output = "--- Security Audit: Encryption Check ---\n";

$penduduk = DB::table('penduduk')->select('nik', 'nama')->limit(3)->get();

foreach ($penduduk as $p) {
    $output .= "Nama: " . $p->nama . "\n";
    $output .= "Raw NIK in DB (First 20 chars): " . substr($p->nik, 0, 20) . "...\n";

    try {
        $decrypted = Crypt::decryptString($p->nik);
        $output .= "Decryption Status: SUCCESS\n";
    }
    catch (\Exception $e) {
        $output .= "Decryption Status: FAILED (Value might not be encrypted or key mismatch)\n";
    }
    $output .= "---------------------------------\n";
}

$keluarga = DB::table('keluarga')->select('no_kk', 'kepala_keluarga')->limit(1)->get();
foreach ($keluarga as $k) {
    $output .= "Kepala Keluarga: " . $k->kepala_keluarga . "\n";
    $output .= "Raw No KK in DB (First 20 chars): " . substr($k->no_kk, 0, 20) . "...\n";
    try {
        $decrypted = Crypt::decryptString($k->no_kk);
        $output .= "Decryption Status: SUCCESS\n";
    }
    catch (\Exception $e) {
        $output .= "Decryption Status: FAILED\n";
    }
}

file_put_contents('audit_results.txt', $output);
echo "Audit complete. Results in audit_results.txt\n";
