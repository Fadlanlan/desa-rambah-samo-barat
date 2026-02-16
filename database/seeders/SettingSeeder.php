<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'Desa Rambah Samo Barat', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Website Resmi Pemerintah Desa Rambah Samo Barat, Kabupaten Rokan Hulu.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'welcome_text', 'value' => 'Selamat Datang di Portal Informasi Desa Rambah Samo Barat', 'type' => 'text', 'group' => 'general'],

            // Contact
            ['key' => 'contact_address', 'value' => 'Jl. Utama Desa Rambah Samo Barat, Kec. Rambah Samo, Kab. Rokan Hulu, Riau', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '0812-3456-7890', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'admin@rambahsamobarat.desa.id', 'type' => 'text', 'group' => 'contact'],

            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/desarambahsamobarat', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/desarambahsamobarat', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/desarambahsamobarat', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/desarambahsamobarat', 'type' => 'text', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
