<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions List
        $permissions = [
            // User Management
            'user.view', 'user.create', 'user.edit', 'user.delete',
            // Role Management
            'role.view', 'role.create', 'role.edit', 'role.delete',
            // Village Profile
            'village.view', 'village.edit',
            // Population / Residents
            'penduduk.view', 'penduduk.create', 'penduduk.edit', 'penduduk.delete', 'penduduk.import', 'penduduk.export',
            // Family Cards
            'keluarga.view', 'keluarga.create', 'keluarga.edit', 'keluarga.delete',
            // Content (Detailed)
            'berita.view', 'berita.create', 'berita.edit', 'berita.delete', 'berita.publish',
            'agenda.view', 'agenda.create', 'agenda.edit', 'agenda.delete',
            'pengumuman.view', 'pengumuman.create', 'pengumuman.edit', 'pengumuman.delete',
            'galeri.view', 'galeri.create', 'galeri.edit', 'galeri.delete',
            // Dokumen
            'dokumen.view', 'dokumen.create', 'dokumen.edit', 'dokumen.delete',
            // Wisata
            'wisata.view', 'wisata.create', 'wisata.edit', 'wisata.delete',
            // Kontak
            'kontak.view', 'kontak.edit',
            // General Content (Legacy/Broad)
            'content.view', 'content.create', 'content.edit', 'content.delete', 'content.publish',
            // Letters / Surat
            'surat.view', 'surat.create', 'surat.edit', 'surat.delete', 'surat.approve', 'surat.sign',
            // Letter Types / Jenis Surat
            'jenis-surat.view', 'jenis-surat.create', 'jenis-surat.edit', 'jenis-surat.delete',
            // Complaints
            'pengaduan.view', 'pengaduan.create', 'pengaduan.process', 'pengaduan.delete',
            // Queue / Antrian
            'antrian.view', 'antrian.manage',
            // Budget / APBDes
            'apbdes.view', 'apbdes.create', 'apbdes.edit', 'apbdes.delete',
            // UMKM
            'umkm.view', 'umkm.create', 'umkm.edit', 'umkm.delete', 'umkm.verify',
            // Settings
            'setting.view', 'setting.edit',
            // Logs
            'log.view',
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles and Assign Permissions

        // 1. Super Admin - Has Everything
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // 2. Admin (Sekretaris Desa/Operator Utama)
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'user.view', 'user.create', 'user.edit',
            'village.view', 'village.edit',
            'penduduk.view', 'penduduk.create', 'penduduk.edit', 'penduduk.import', 'penduduk.export',
            'keluarga.view', 'keluarga.create', 'keluarga.edit',
            'content.view', 'content.create', 'content.edit', 'content.delete', 'content.publish',
            'berita.view', 'berita.create', 'berita.edit', 'berita.delete', 'berita.publish',
            'agenda.view', 'agenda.create', 'agenda.edit', 'agenda.delete',
            'pengumuman.view', 'pengumuman.create', 'pengumuman.edit', 'pengumuman.delete',
            'galeri.view', 'galeri.create', 'galeri.edit', 'galeri.delete',
            'dokumen.view', 'dokumen.create', 'dokumen.edit', 'dokumen.delete',
            'wisata.view', 'wisata.create', 'wisata.edit', 'wisata.delete',
            'kontak.view', 'kontak.edit',
            'surat.view', 'surat.create', 'surat.edit', 'surat.approve',
            'jenis-surat.view', 'jenis-surat.create', 'jenis-surat.edit', 'jenis-surat.delete',
            'pengaduan.view', 'pengaduan.process',
            'antrian.view', 'antrian.manage',
            'apbdes.view', 'apbdes.create', 'apbdes.edit',
            'umkm.view', 'umkm.verify',
            'setting.view',
            'log.view',
        ]);

        // 3. Kades (Kepala Desa) - Approval & Viewing Reports
        $kades = Role::firstOrCreate(['name' => 'kades']);
        $kades->givePermissionTo([
            'village.view',
            'penduduk.view',
            'keluarga.view',
            'content.view',
            'surat.view', 'surat.approve', 'surat.sign',
            'pengaduan.view',
            'apbdes.view',
            'umkm.view',
            'log.view',
        ]);

        // 4. Operator (Staf Pelayanan)
        $operator = Role::firstOrCreate(['name' => 'operator']);
        $operator->givePermissionTo([
            'penduduk.view', 'penduduk.create', 'penduduk.edit',
            'keluarga.view', 'keluarga.create', 'keluarga.edit',
            'surat.view', 'surat.create', 'surat.edit',
            'pengaduan.view', 'pengaduan.process',
            'antrian.view', 'antrian.manage',
        ]);

        // 5. Warga (Resident)
        $warga = Role::firstOrCreate(['name' => 'warga']);
        $warga->givePermissionTo([
            'surat.create', 'surat.view',
            'pengaduan.create', 'pengaduan.view',
            'umkm.create', 'umkm.view', 'umkm.edit', // Own UMKM only logic handled in policy
        ]);
    }
}
