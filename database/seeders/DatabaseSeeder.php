<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class ,
        ]);

        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@desarambahsamobarat.id',
            'password' => bcrypt('password'), // Change in production
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        $user->assignRole('super-admin');

        $this->call([
            DemoSeeder::class ,
        ]);
    }
}
