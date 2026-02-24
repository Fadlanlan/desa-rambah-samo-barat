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
            'password' => 'AdminDesa123!', // Model cast 'hashed' auto-hashes this
        ]
        );

        $user->assignRole('super-admin');
    }
}
