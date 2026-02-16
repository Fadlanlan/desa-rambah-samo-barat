<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Keluarga;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_penduduk' => Penduduk::count(),
            'total_keluarga' => Keluarga::count(),
            'total_berita' => Berita::count(),
            'penduduk_aktif' => Penduduk::where('status', 'aktif')->count(),
        ];

        // Gender Distribution
        $genderStats = Penduduk::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin');

        // Age Groups (Database-agnostic calculation using date boundaries)
        $now = now();
        $ageStats = [
            'balita' => Penduduk::where('tanggal_lahir', '>', $now->copy()->subYears(5))->count(),
            'anak' => Penduduk::whereBetween('tanggal_lahir', [$now->copy()->subYears(12), $now->copy()->subYears(5)])->count(),
            'remaja' => Penduduk::whereBetween('tanggal_lahir', [$now->copy()->subYears(18), $now->copy()->subYears(13)])->count(),
            'dewasa' => Penduduk::whereBetween('tanggal_lahir', [$now->copy()->subYears(60), $now->copy()->subYears(18)])->count(),
            'lansia' => Penduduk::where('tanggal_lahir', '<=', $now->copy()->subYears(60))->count(),
        ];

        $recentPenduduk = Penduduk::latest()->limit(5)->get();
        $recentBerita = Berita::latest()->limit(5)->get();

        // Surat Stats
        $suratService = app(\App\Services\Pelayanan\SuratService::class);
        $suratStats = $suratService->getDashboardStats();
        $recentSurat = \App\Models\Surat::with(['penduduk', 'jenisSurat'])->latest()->limit(5)->get();

        return view('dashboard', compact('stats', 'genderStats', 'ageStats', 'recentPenduduk', 'recentBerita', 'suratStats', 'recentSurat'));
    }
}
