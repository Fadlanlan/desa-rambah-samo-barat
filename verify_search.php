<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use App\Models\User;
use Illuminate\Support\Facades\Auth;

try {
    // 1. Authenticate as an Admin (assuming ID 1 or first admin)
    $user = User::whereHas('roles', function ($q) {
        $q->where('name', 'admin'); })->first();
    if (!$user) {
        $user = User::first();
    }
    Auth::login($user);
    echo "Authenticated as: " . $user->name . " (Role: " . $user->roles->pluck('name')->implode(', ') . ")\n";

    // 2. Test Search for Features
    echo "Testing Feature Search (query: 'Berita')...\n";
    $request = Illuminate\Http\Request::create('/admin/search', 'GET', ['q' => 'Berita']);
    $response = $kernel->handle($request);
    echo "Response Code: " . $response->getStatusCode() . "\n";
    echo "Results: " . count(json_decode($response->getContent(), true)) . " items found.\n";
    print_r(json_decode($response->getContent(), true));

    // 3. Test Search for Data (Penduduk/Warga)
    // Find a random Penduduk to search
    $penduduk = \App\Models\Penduduk::first();
    if ($penduduk) {
        echo "\nTesting Data Search (query: '{$penduduk->nama}')...\n";
        $request = Illuminate\Http\Request::create('/admin/search', 'GET', ['q' => $penduduk->nama]);
        $response = $kernel->handle($request);
        echo "Response Code: " . $response->getStatusCode() . "\n";
        echo "Results: " . count(json_decode($response->getContent(), true)) . " items found.\n";
        print_r(json_decode($response->getContent(), true));
    }
    else {
        echo "\nNo Penduduk data found to test searching.\n";
    }

}
catch (\Throwable $e) {
    echo "Caught Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
