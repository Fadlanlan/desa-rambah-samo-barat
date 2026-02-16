<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Berita Desa',
                'description' => 'Berita dan informasi terkini seputar kegiatan desa.',
                'color' => 'bg-blue-500',
                'icon' => 'newspaper'
            ],
            [
                'name' => 'Pengumuman',
                'description' => 'Informasi penting dan pengumuman resmi dari pemerintah desa.',
                'color' => 'bg-amber-500',
                'icon' => 'bullhorn'
            ],
            [
                'name' => 'Agenda Kegiatan',
                'description' => 'Jadwal kegiatan dan acara yang akan dilaksanakan di desa.',
                'color' => 'bg-emerald-500',
                'icon' => 'calendar'
            ],
            [
                'name' => 'Layanan Masyarakat',
                'description' => 'Informasi seputar pelayanan administrasi dan publik.',
                'color' => 'bg-purple-500',
                'icon' => 'users'
            ],
            [
                'name' => 'Potensi Desa',
                'description' => 'Artikel mengenai potensi ekonomi, wisata, dan budaya desa.',
                'color' => 'bg-indigo-500',
                'icon' => 'chart-bar'
            ],
            [
                'name' => 'Pembangunan',
                'description' => 'Update progres pembangunan infrastruktur desa.',
                'color' => 'bg-orange-500',
                'icon' => 'truck'
            ],
            [
                'name' => 'Transparansi Anggaran',
                'description' => 'Laporan dan informasi transparansi keuangan desa.',
                'color' => 'bg-teal-500',
                'icon' => 'currency-dollar'
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
            ['slug' => Str::slug($category['name'])],
            [
                'name' => $category['name'],
                'description' => $category['description'],
                'color' => $category['color'],
                'icon' => $category['icon']
            ]
            );
        }
    }
}
