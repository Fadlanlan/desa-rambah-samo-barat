<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Penduduk;
use Illuminate\Support\Facades\Crypt;

$output = "--- Final Security Verification ---\n";

$p = Penduduk::first();
if ($p) {
    $rawNik = $p->nik; // Decrypted by trait
    $hash = hash_hmac('sha256', $rawNik, config('app.key'));

    $output .= "Nama: " . $p->nama . "\n";
    $output .= "NIK Hash in DB match: " . ($p->nik_hash === $hash ? "YES" : "NO") . "\n";

    $found = Penduduk::where('nik_hash', $hash)->first();
    $output .= "Search by Hash: " . ($found && $found->id === $p->id ? "SUCCESS" : "FAILED") . "\n";
}
else {
    $output .= "No records found to verify.\n";
}

file_put_contents('final_security_verify.txt', $output);
echo "Verification complete. Results in final_security_verify.txt\n";
