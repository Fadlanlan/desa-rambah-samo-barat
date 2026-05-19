<?php

use App\Models\User;
use App\Models\Setting;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SettingSeeder;

test('admin can update public menu settings successfully', function () {
    // Seed roles and settings
    $this->seed(RolePermissionSeeder::class);
    $this->seed(SettingSeeder::class);

    $user = User::factory()->create();
    $user->assignRole('admin');

    // Default seeded value is '1' (ON)
    expect(Setting::get('menu_public_profil'))->toBe('1');

    // Admin updates setting values
    $response = $this
        ->actingAs($user)
        ->patch(route('pengaturan.update'), [
            'menu_public_profil' => '0',
            'menu_public_berita' => '0',
            'menu_public_surat' => '1',
            'menu_public_antrian' => '1',
            'menu_public_galeri' => '1',
            'menu_public_pengaduan' => '1',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    // Verify settings were successfully toggled OFF
    expect(Setting::get('menu_public_profil'))->toBe('0');
    expect(Setting::get('menu_public_berita'))->toBe('0');
    expect(Setting::get('menu_public_surat'))->toBe('1');
});

test('public menu is hidden and route is protected when disabled', function () {
    $this->seed(SettingSeeder::class);

    // Disable Profil Desa menu
    Setting::updateOrCreate(
        ['key' => 'menu_public_profil'],
        ['value' => '0', 'type' => 'boolean', 'group' => 'menu']
    );

    // 1. Assert links are completely absent from the public page
    $response = $this->get(route('home'));
    $response->assertStatus(200);
    $response->assertDontSee(route('public.profil.index'));
    $response->assertDontSee('Profil Lengkap');

    // 2. Assert direct URL requests are intercepted and redirected with a warning
    $redirectResponse = $this->get(route('public.profil.index'));
    $redirectResponse->assertRedirect(route('home'));
    $redirectResponse->assertSessionHas('warning', 'Halaman Profil Desa sedang tidak aktif.');
});

test('public menu is visible and accessible when enabled', function () {
    $this->seed(SettingSeeder::class);

    // Enable Profil Desa menu
    Setting::updateOrCreate(
        ['key' => 'menu_public_profil'],
        ['value' => '1', 'type' => 'boolean', 'group' => 'menu']
    );

    // 1. Assert links are visible on the public page
    $response = $this->get(route('home'));
    $response->assertStatus(200);
    $response->assertSee(route('public.profil.index'));

    // 2. Assert direct URL access is permitted
    $routeResponse = $this->get(route('public.profil.index'));
    $routeResponse->assertStatus(200);
});
