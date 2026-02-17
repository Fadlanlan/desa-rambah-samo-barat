<?php
use App\Models\User;
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = User::where('email', 'operator@desarambahsamobarat.id')->first();
if ($user) {
    echo "USER FOUND: " . $user->email . "\n";
    echo "ROLES: " . $user->roles->pluck('name')->implode(', ') . "\n";
}
else {
    echo "USER NOT FOUND\n";
}
