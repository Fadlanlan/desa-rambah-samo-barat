<?php
require __DIR__ . '/vendor/autoload.php';

echo "Autoloader loaded.\n";

try {
    echo "Attempting to instantiate Antrian Model...\n";
    $model = new \App\Models\Antrian();
    echo "Model instantiated.\n";

    echo "Attempting to instantiate AntrianRepository...\n";
    $repo = new \App\Repositories\Eloquent\AntrianRepository($model);
    echo "Repository instantiated.\n";
}
catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
echo "Done.\n";
