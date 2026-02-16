<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Penduduk;
use App\Models\Keluarga;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

echo "--- Backfilling Blind Indices ---\n";

DB::transaction(function () {
    echo "Processing Penduduk...\n";
    // We must use retrieved event or manual decryption
    Penduduk::all()->each(function ($p) {
            $p->save(); // Trait will handle hash generation on saving
        }
        );
        echo "Done Penduduk.\n";

        echo "Processing Keluarga...\n";
        Keluarga::all()->each(function ($k) {
            $k->save();
        }
        );
        echo "Done Keluarga.\n";    });

echo "Backfill Complete!\n";
