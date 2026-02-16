<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email = 'admin@desarambahsamobarat.id';
$password = 'AdminDesa123!';

$user = User::where('email', $email)->first();

if ($user) {
    // Force update password and ensure it's active
    $user->update([
        'password' => $password, // Model has 'hashed' cast, so this will hash it
        'is_active' => true,
        'locked_until' => null,
    ]);

    // Ensure roles are correct too
    $user->syncRoles(['Super Admin', 'super-admin']);

    file_put_contents('force_fix.txt', "SUCCESS: Password and status forced for $email. Hash: " . $user->password);
}
else {
    $user = User::create([
        'name' => 'Super Admin',
        'email' => $email,
        'password' => $password,
        'is_active' => true,
    ]);
    $user->assignRole('Super Admin');
    file_put_contents('force_fix.txt', "SUCCESS: User $email created with password $password");
}
