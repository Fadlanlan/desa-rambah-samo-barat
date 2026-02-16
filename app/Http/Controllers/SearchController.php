<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Keluarga;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Agenda;
use App\Models\UMKM;
use App\Models\Wisata;
use App\Models\Surat;
use App\Models\Pengaduan;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // 1. Features / Menu Items
        $menus = $this->getMenus();
        foreach ($menus as $menu) {
            if (stripos($menu['name'], $query) !== false) {
                $results[] = [
                    'title' => $menu['name'],
                    'category' => 'Fitur',
                    'url' => $menu['url'],
                    'icon' => 'cog'
                ];
            }
        }

        // 2. Data Search
        // Kependudukan
        Penduduk::where('nama', 'like', "%{$query}%")
            ->orWhere('nik', 'like', "%{$query}%")
            ->limit(5)->get()->each(function ($item) use (&$results) {
            $results[] = [
                'title' => $item->nama . " ({$item->nik})",
                'category' => 'Warga',
                'url' => route('warga.show', $item->id),
                'icon' => 'user'
            ];
        });

        Keluarga::where('no_kk', 'like', "%{$query}%")
            ->orWhere('kepala_keluarga', 'like', "%{$query}%")
            ->limit(5)->get()->each(function ($item) use (&$results) {
            $results[] = [
                'title' => "KK: " . $item->no_kk . " (" . $item->kepala_keluarga . ")",
                'category' => 'Keluarga',
                'url' => route('keluarga.show', $item->id),
                'icon' => 'users'
            ];
        });

        // Konten
        Berita::where('judul', 'like', "%{$query}%")
            ->limit(5)->get()->each(function ($item) use (&$results) {
            $results[] = [
                'title' => $item->judul,
                'category' => 'Berita',
                'url' => route('berita.edit', $item->id),
                'icon' => 'newspaper'
            ];
        });

        Pengumuman::where('judul', 'like', "%{$query}%")
            ->limit(5)->get()->each(function ($item) use (&$results) {
            $results[] = [
                'title' => $item->judul,
                'category' => 'Pengumuman',
                'url' => route('pengumuman.edit', $item->id),
                'icon' => 'megaphone'
            ];
        });

        // Layanan
        Surat::where('nomor_tiket', 'like', "%{$query}%")
            ->orWhere('nama_pemohon', 'like', "%{$query}%")
            ->limit(5)->get()->each(function ($item) use (&$results) {
            $results[] = [
                'title' => "Surat: " . $item->nomor_tiket . " (" . $item->nama_pemohon . ")",
                'category' => 'Layanan Surat',
                'url' => route('surat.show', $item->id),
                'icon' => 'document'
            ];
        });

        return response()->json($results);
    }

    private function getMenus()
    {
        $menus = [
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Daftar Warga', 'url' => route('warga.index')],
            ['name' => 'Tambah Warga', 'url' => route('warga.create')],
            ['name' => 'Daftar Keluarga', 'url' => route('keluarga.index')],
            ['name' => 'Tambah Keluarga', 'url' => route('keluarga.create')],
            ['name' => 'Daftar Berita', 'url' => route('berita.index')],
            ['name' => 'Tambah Berita', 'url' => route('berita.create')],
            ['name' => 'Permohonan Surat', 'url' => route('surat.index')],
            ['name' => 'Jenis Surat', 'url' => route('jenis-surat.index')],
            ['name' => 'Aduan Warga', 'url' => route('pengaduan.index')],
            ['name' => 'Antrian Online', 'url' => route('antrian.index')],
            ['name' => 'Pengumuman', 'url' => route('pengumuman.index')],
            ['name' => 'Agenda', 'url' => route('agenda.index')],
            ['name' => 'Galeri Foto', 'url' => route('galeri.index')],
            ['name' => 'Wisata Desa', 'url' => route('wisata.index')],
            ['name' => 'APBDes', 'url' => route('apbdes.index')],
            ['name' => 'UMKM', 'url' => route('umkm.index')],
            ['name' => 'Audit Log', 'url' => route('audit.index')],
            ['name' => 'Pengaturan', 'url' => route('pengaturan.index')],
        ];

        if (auth()->check() && auth()->user()->hasRole('super-admin')) {
            $menus[] = ['name' => 'Super Dashboard', 'url' => route('superadmin.dashboard')];
            $menus[] = ['name' => 'Manajemen User', 'url' => route('superadmin.user.index')];
            $menus[] = ['name' => 'Sistem & Log', 'url' => route('superadmin.system')];
        }

        return $menus;
    }
}
