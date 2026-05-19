<?php

use App\Models\User;
use App\Models\Setting;
use Database\Seeders\RolePermissionSeeder;

test('admin can update theme settings successfully', function () {
    // Seed roles and permissions
    $this->seed(RolePermissionSeeder::class);

    $user = User::factory()->create();
    $user->assignRole('admin');

    // Set initial settings in database (or they are already seeded, but we'll be safe)
    Setting::updateOrCreate(
        ['key' => 'theme_primary_color'],
        ['value' => '#0c89eb', 'type' => 'color', 'group' => 'theme']
    );
    Setting::updateOrCreate(
        ['key' => 'theme_secondary_color'],
        ['value' => '#36b735', 'type' => 'color', 'group' => 'theme']
    );

    $response = $this
        ->actingAs($user)
        ->patch(route('pengaturan.update'), [
            'theme_primary_color' => '#ff0000',
            'theme_secondary_color' => '#00ff00',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect(Setting::get('theme_primary_color'))->toBe('#ff0000');
    expect(Setting::get('theme_secondary_color'))->toBe('#00ff00');
});
