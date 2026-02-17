<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$email = 'operator@desarambahsamobarat.id';
$password = 'password';

$user = User::firstOrCreate(
['email' => $email],
[
    'name' => 'Admin Desa',
    'password' => Hash::make($password),
    'email_verified_at' => now(),
    'is_active' => true,
]
);

// Ensure it has the admin role
$user->assignRole('admin');

echo "Akun Berhasil Dibuat!\n";
echo "Email: $email\n";
echo "Password: $password\n";
echo "Role: Admin\n";
