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

        $totalPenduduk = Penduduk::count();
        $totalKeluarga = Keluarga::count();
        $totalUmkm = Umkm::where('is_active', true)->count();
        $totalDusun = Penduduk::whereNotNull('dusun')->distinct('dusun')->count('dusun');
        $totalRt = Penduduk::whereNotNull('rt')->distinct('rt')->count('rt');

        $statsGender = [
            'Laki-laki' => Penduduk::whereIn('jenis_kelamin', ['L', 'Laki-laki', 'LAKI-LAKI'])->count(),
            'Perempuan' => Penduduk::whereIn('jenis_kelamin', ['P', 'Perempuan', 'PEREMPUAN'])->count(),
        ];

        $statsPendidikanRaw = Penduduk::selectRaw('pendidikan_terakhir, count(*) as total')
            ->groupBy('pendidikan_terakhir')
            ->get()
            ->pluck('total', 'pendidikan_terakhir')
            ->toArray();
        
        $statsPendidikan = [
            'SD' => $statsPendidikanRaw['SD'] ?? $statsPendidikanRaw['SD/SEDERAJAT'] ?? 0,
            'SMP' => $statsPendidikanRaw['SMP'] ?? $statsPendidikanRaw['SMP/SEDERAJAT'] ?? 0,
            'SMA/SMK' => ($statsPendidikanRaw['SMA'] ?? 0) + ($statsPendidikanRaw['SMK'] ?? 0) + ($statsPendidikanRaw['SMA/SMK'] ?? 0) + ($statsPendidikanRaw['SMA/SEDERAJAT'] ?? 0),
            'Diploma/S1' => ($statsPendidikanRaw['D3'] ?? 0) + ($statsPendidikanRaw['S1'] ?? 0) + ($statsPendidikanRaw['Diploma/S1'] ?? 0) + ($statsPendidikanRaw['SARJANA'] ?? 0),
            'Tidak Sekolah' => $statsPendidikanRaw['Tidak Sekolah'] ?? $statsPendidikanRaw['TIDAK / BELUM SEKOLAH'] ?? 0,
        ];

        $statsPekerjaanRaw = Penduduk::selectRaw('pekerjaan, count(*) as total')
            ->groupBy('pekerjaan')
            ->get()
            ->pluck('total', 'pekerjaan')
            ->toArray();
        
        $statsPekerjaan = [
            'Petani' => $statsPekerjaanRaw['Petani'] ?? $statsPekerjaanRaw['PETANI'] ?? 0,
            'Swasta' => $statsPekerjaanRaw['Swasta'] ?? $statsPekerjaanRaw['Karyawan Swasta'] ?? $statsPekerjaanRaw['SWASTA'] ?? 0,
            'PNS/TNI/Polri' => ($statsPekerjaanRaw['PNS'] ?? 0) + ($statsPekerjaanRaw['TNI'] ?? 0) + ($statsPekerjaanRaw['Polri'] ?? 0) + ($statsPekerjaanRaw['PNS/TNI/Polri'] ?? 0),
            'Wiraswasta' => $statsPekerjaanRaw['Wiraswasta'] ?? $statsPekerjaanRaw['Wiraswasta'] ?? $statsPekerjaanRaw['WIRASWASTA'] ?? 0,
            'Lainnya' => $statsPekerjaanRaw['Lainnya'] ?? $statsPekerjaanRaw['LAINNYA'] ?? $statsPekerjaanRaw['BELUM/TIDAK BEKERJA'] ?? 0,
        ];

        $date15YearsAgo = now()->subYears(15)->format('Y-m-d');
        $date65YearsAgo = now()->subYears(65)->format('Y-m-d');

        $statsUsia = [
            'Anak-anak (0-14)' => Penduduk::where('tanggal_lahir', '>', $date15YearsAgo)->count(),
            'Produktif (15-64)' => Penduduk::where('tanggal_lahir', '<=', $date15YearsAgo)
                                           ->where('tanggal_lahir', '>', $date65YearsAgo)->count(),
            'Lansia (65+)' => Penduduk::where('tanggal_lahir', '<=', $date65YearsAgo)->count(),
        ];

        $stats = [
            'penduduk' => $totalPenduduk,
            'keluarga' => $totalKeluarga,
            'dusun' => $totalDusun,
            'rt_rw' => $totalRt,
            'umkm' => $totalUmkm,
            'program' => 12,
            'transparansi' => '100%'
        ];

        $galleries = Galeri::where('is_active', true)->latest()->take(8)->get();
        $umkms = Umkm::where('is_active', true)->latest()->take(4)->get();
        $wisatas = Wisata::where('is_active', true)->latest()->take(3)->get();

        $isLocked = \App\Models\Setting::get('system_lock_user', '0') === '1';

        $village = \App\Models\Village::first();
        $kepalaDesa = null;
        if ($village && $village->struktur_organisasi) {
            $strukturData = is_string($village->struktur_organisasi) ? json_decode($village->struktur_organisasi, true) : $village->struktur_organisasi;
            if (is_array($strukturData)) {
                foreach ($strukturData as $struktur) {
                    if (stripos($struktur['jabatan'] ?? '', 'Kepala Desa') !== false) {
                        $kepalaDesa = $struktur;
                        break;
                    }
                }
            }
        }

        return view('welcome', compact(
            'latestNews', 'featuredNews', 'stats', 'statsGender', 'statsPendidikan', 
            'statsPekerjaan', 'statsUsia', 'galleries', 'umkms', 'wisatas', 
            'pengumuman', 'agenda', 'isLocked', 'village', 'kepalaDesa'
        ));
    }
}
