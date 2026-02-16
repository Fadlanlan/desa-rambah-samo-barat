<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Setting;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Checking for settings table...\n";

try {
    if (!Schema::hasTable('settings')) {
        echo "Table 'settings' does not exist. Creating it...\n";
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text');
            $table->string('group')->default('general');
            $table->timestamps();
        });
        echo "Table 'settings' created successfully.\n";
    }
    else {
        echo "Table 'settings' already exists.\n";
    }

    echo "Seeding data...\n";
    $settings = [
        ['key' => 'site_name', 'value' => 'Desa Rambah Samo Barat', 'type' => 'text', 'group' => 'general'],
        ['key' => 'site_description', 'value' => 'Website Resmi Pemerintah Desa Rambah Samo Barat, Kabupaten Rokan Hulu.', 'type' => 'textarea', 'group' => 'general'],
        ['key' => 'contact_address', 'value' => 'Jl. Poros Desa, Rambah Samo Barat, Kec. Rambah Samo, Kabupaten Rokan Hulu, Riau', 'type' => 'textarea', 'group' => 'contact'],
        ['key' => 'contact_phone', 'value' => '0812-3456-7890', 'type' => 'text', 'group' => 'contact'],
        ['key' => 'contact_email', 'value' => 'info@desarambahsamobarat.id', 'type' => 'text', 'group' => 'contact'],
        ['key' => 'social_facebook', 'value' => 'https://facebook.com/desarambahsamobarat', 'type' => 'text', 'group' => 'social'],
        ['key' => 'social_instagram', 'value' => 'https://instagram.com/desarambahsamobarat', 'type' => 'text', 'group' => 'social'],
        ['key' => 'social_twitter', 'value' => 'https://twitter.com/desarambahsamo', 'type' => 'text', 'group' => 'social'],
        ['key' => 'social_youtube', 'value' => 'https://youtube.com/@desarambahsamobarat', 'type' => 'text', 'group' => 'social'],
    ];

    foreach ($settings as $setting) {
        Setting::updateOrCreate(['key' => $setting['key']], $setting);
    }
    echo "Seed completed successfully.\n";

}
catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
