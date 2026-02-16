<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function checkRoute($app, $path, $method = 'GET', $userEmail = null)
{
    if ($userEmail) {
        $user = \App\Models\User::where('email', $userEmail)->first();
        if ($user) {
            \Illuminate\Support\Facades\Auth::login($user);
        }
    }
    else {
        \Illuminate\Support\Facades\Auth::logout();
    }

    $request = \Illuminate\Http\Request::create($path, $method);
    try {
        $response = $app->handle($request);
        return $response->getStatusCode();
    }
    catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
}

$routes = [
    'Public Home' => ['path' => '/', 'user' => null],
    'Public Berita' => ['path' => '/berita', 'user' => null],
    'Public Antrian' => ['path' => '/antrian', 'user' => null],
    'Public Pengaduan' => ['path' => '/lapor', 'user' => null],
    'Admin Dashboard' => ['path' => '/dashboard', 'user' => 'admin@desarambahsamobarat.id'],
    'Admin Berita' => ['path' => '/admin/berita', 'user' => 'admin@desarambahsamobarat.id'],
    'Admin Jenis Surat' => ['path' => '/admin/jenis-surat', 'user' => 'admin@desarambahsamobarat.id'],
];

echo "AUDIT_START\n";
foreach ($routes as $name => $info) {
    $status = checkRoute($app, $info['path'], 'GET', $info['user']);
    echo "[$name] $status\n";
}
echo "AUDIT_END\n";
