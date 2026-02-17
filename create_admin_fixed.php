<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

try {
    require __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

    $email = 'operator@desarambahsamobarat.id';
    $password = 'password';

    DB::beginTransaction();

    $user = User::updateOrCreate(
    ['email' => $email],
    [
        'name' => 'Admin Desa',
        'password' => Hash::make($password),
        'email_verified_at' => now(),
        'is_active' => true,
    ]
    );

    // Ensure it has the admin role
    if (!$user->hasRole('admin')) {
        $user->assignRole('admin');
    }

    DB::commit();

    echo "SUCCESS: Akun Berhasil Dibuat/Diperbarui!\n";
    echo "Email: " . $user->email . "\n";
    echo "Total Users: " . User::count() . "\n";
    foreach (User::all() as $u) {
        echo "- " . $u->email . "\n";
    }

}
catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
