<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
        ['email' => 'admin@desarambahsamobarat.id'],
        [
            'name' => 'Super Admin Desa',
            'password' => Hash::make('AdminDesa123!'),
        ]
        );

        $user->assignRole('super-admin');
    }
}
