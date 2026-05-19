<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Apbdes;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->get('year', 2026);

        // Check if database has any APBDes data for this year
        $hasData = Apbdes::where('tahun_anggaran', $selectedYear)->exists();

        if ($hasData) {
            $totalPendapatan = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'pendapatan')
                ->sum('anggaran');

            $totalPendapatanRealisasi = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'pendapatan')
                ->sum('realisasi');

            $totalBelanja = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'belanja')
                ->sum('anggaran');

            $totalBelanjaRealisasi = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'belanja')
                ->sum('realisasi');

            $totalPembiayaan = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'pembiayaan')
                ->sum('anggaran');

            $totalPembiayaanRealisasi = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'pembiayaan')
                ->sum('realisasi');

            // Breakdown by category/bidang for realization graphs
            $categoriesData = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'belanja')
                ->selectRaw('kategori, sum(anggaran) as total_anggaran, sum(realisasi) as total_realisasi')
                ->groupBy('kategori')
                ->get();
        } else {
            // Real data empty
            $totalPendapatan = 0;
            $totalPendapatanRealisasi = 0;
            $totalBelanja = 0;
            $totalBelanjaRealisasi = 0;
            $totalPembiayaan = 0;
            $totalPembiayaanRealisasi = 0;

            $categoriesData = collect([]);
        }

        // Monthly realization or quarterly realization data for elegant charts
        // Disabling monthly chart due to DB schema limitation, supplying empty
        $monthlyRealisasi = [];

        $years = Apbdes::distinct()->pluck('tahun_anggaran')->toArray();
        if (empty($years)) {
            $years = [date('Y')];
        }

        $realizationProgress = $totalBelanja > 0 ? round(($totalBelanjaRealisasi / $totalBelanja) * 100, 1) : 0;
        $pendapatanProgress = $totalPendapatan > 0 ? round(($totalPendapatanRealisasi / $totalPendapatan) * 100, 1) : 0;
        $pembiayaanProgress = $totalPembiayaan > 0 ? round(($totalPembiayaanRealisasi / $totalPembiayaan) * 100, 1) : 0;

        return view('public.realisasi.index', compact(
            'selectedYear', 'totalPendapatan', 'totalPendapatanRealisasi', 'totalBelanja', 
            'totalBelanjaRealisasi', 'totalPembiayaan', 'totalPembiayaanRealisasi',
            'categoriesData', 'monthlyRealisasi', 'years', 'realizationProgress',
            'pendapatanProgress', 'pembiayaanProgress'
        ));
    }
}
