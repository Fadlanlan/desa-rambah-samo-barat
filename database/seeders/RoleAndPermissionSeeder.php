<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view residents',
            'create residents',
            'edit residents',
            'delete residents',
            'import residents',
            'export residents',
            'view families',
            'create families',
            'edit families',
            'delete families',
            'view news',
            'create news',
            'edit news',
            'delete news',
            'view letter types',
            'create letter types',
            'edit letter types',
            'delete letter types',
            'view letters',
            'create letters',
            'process letters',
            'delete letters',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $roleConfigs = [
            'super-admin' => $permissions,
            'admin' => $permissions, // Give admin all for now, can be restricted later
            'warga' => []
        ];

        foreach ($roleConfigs as $roleName => $assignedPermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            if (!empty($assignedPermissions)) {
                $role->syncPermissions($assignedPermissions);
            }
        }
    }
}
