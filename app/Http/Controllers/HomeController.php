<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Penduduk;
use App\Models\Keluarga;
use App\Models\Galeri;
use App\Models\Umkm;
use App\Models\Wisata;
use App\Models\Pengumuman;
use App\Models\Agenda;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestNews = Berita::published()
            ->with('category')
            ->latest('published_at')
            ->limit(3)
            ->get();

        $featuredNews = Berita::published()
            ->featured()
            ->with('category')
            ->latest('published_at')
            ->first();

        // Fetch Announcements (Latest active)
        $pengumuman = Pengumuman::where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        // Fetch Agenda (Upcoming active)
        $agenda = Agenda::where('is_active', true)
            ->whereDate('tanggal_mulai', '>=', now())
            ->orderBy('tanggal_mulai', 'asc')
            ->take(3)
            ->get();

        $stats = [
            'penduduk' => Penduduk::count() ?: 2540, // Fallback to dummy if empty
            'keluarga' => Keluarga::count() ?: 782,
            'program' => 12,
            'transparansi' => '100%'
        ];

        $galleries = Galeri::where('is_active', true)->latest()->take(8)->get();
        $umkms = Umkm::where('is_active', true)->latest()->take(4)->get();
        $wisatas = Wisata::where('is_active', true)->latest()->take(3)->get();

        $isLocked = \App\Models\Setting::get('system_lock_user', '0') === '1';

        return view('welcome', compact('latestNews', 'featuredNews', 'stats', 'galleries', 'umkms', 'wisatas', 'pengumuman', 'agenda', 'isLocked'));
    }
}
