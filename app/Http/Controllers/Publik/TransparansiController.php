<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Apbdes;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class TransparansiController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->get('year', 2026);
        
        // Check if database has any APBDes data
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

            $categories = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'belanja')
                ->selectRaw('kategori, sum(anggaran) as total_anggaran, sum(realisasi) as total_realisasi')
                ->groupBy('kategori')
                ->get()
                ->pluck('total_anggaran', 'kategori')
                ->toArray();

            $realizationData = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'belanja')
                ->selectRaw('kategori, sum(realisasi) as total_realisasi')
                ->groupBy('kategori')
                ->get()
                ->pluck('total_realisasi', 'kategori')
                ->toArray();

            // Fetch dynamic programs
            $programs = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'belanja')
                ->take(6)
                ->get()
                ->map(function ($item) {
                    $pct = $item->anggaran > 0 ? round(($item->realisasi / $item->anggaran) * 100) : 0;
                    $status = 'Perencanaan';
                    if ($pct >= 100) {
                        $status = 'Selesai';
                    } elseif ($pct > 0) {
                        $status = 'Berjalan';
                    }
                    return [
                        'nama' => $item->uraian,
                        'tahun' => $item->tahun_anggaran,
                        'status' => $status,
                        'progress' => $pct,
                        'dana' => $item->realisasi,
                        'anggaran' => $item->anggaran,
                        'deskripsi' => $item->keterangan ?? 'Program pembangunan desa terpadu.',
                    ];
                });
        } else {
            // Fallback High-Fidelity Mock Data for 2026
            $totalPendapatan = 2455000000;
            $totalPendapatanRealisasi = 2405000000;
            $totalBelanja = 2475000000;
            $totalBelanjaRealisasi = 2240000000;

            $categories = [
                'Pemerintahan' => 650000000,
                'Infrastruktur' => 980000000,
                'Pendidikan' => 180000000,
                'Kesehatan' => 220000000,
                'Sosial' => 240000000,
                'UMKM' => 950000000,
                'Ketahanan Pangan' => 110000000
            ];

            $realizationData = [
                'Pemerintahan' => 645000000,
                'Infrastruktur' => 820000000,
                'Pendidikan' => 150000000,
                'Kesehatan' => 215000000,
                'Sosial' => 180000000,
                'UMKM' => 850000000,
                'Ketahanan Pangan' => 950000000
            ];

            $programs = collect([
                [
                    'nama' => 'Pembangunan Jalan Semenisasi Dusun I',
                    'tahun' => 2026,
                    'status' => 'Selesai',
                    'progress' => 100,
                    'dana' => 185000000,
                    'anggaran' => 185000000,
                    'deskripsi' => 'Semenisasi jalan desa penghubung antar RT untuk akses pertanian yang lebih lancar.'
                ],
                [
                    'nama' => 'Pemberian Makanan Tambahan Balita & Posyandu',
                    'tahun' => 2026,
                    'status' => 'Selesai',
                    'progress' => 100,
                    'dana' => 45000000,
                    'anggaran' => 45000000,
                    'deskripsi' => 'Program kesehatan stunting terpadu berupa PMT rutin bulanan bagi balita di 4 Posyandu.'
                ],
                [
                    'nama' => 'Rehabilitasi Jembatan Penghubung Dusun III',
                    'tahun' => 2026,
                    'status' => 'Berjalan',
                    'progress' => 75,
                    'dana' => 210000000,
                    'anggaran' => 280000000,
                    'deskripsi' => 'Perbaikan struktur jembatan kayu menjadi beton cor agar kuat dilalui kendaraan roda empat.'
                ],
                [
                    'nama' => 'Penyaluran BLT-DD Tahap I & II',
                    'tahun' => 2026,
                    'status' => 'Berjalan',
                    'progress' => 50,
                    'dana' => 120000000,
                    'anggaran' => 240000000,
                    'deskripsi' => 'Bantuan Langsung Tunai Dana Desa bagi 40 Keluarga Penerima Manfaat (KPM) miskin ekstrem.'
                ],
                [
                    'nama' => 'Pelatihan Budidaya Ikan Nila Desa',
                    'tahun' => 2026,
                    'status' => 'Berjalan',
                    'progress' => 85,
                    'dana' => 42500000,
                    'anggaran' => 50000000,
                    'deskripsi' => 'Pelatihan ketahanan pangan mandiri melalui pembuatan kolam bioflok bagi pemuda tani.'
                ],
                [
                    'nama' => 'Pembangunan Saluran Drainase Dusun II',
                    'tahun' => 2026,
                    'status' => 'Perencanaan',
                    'progress' => 0,
                    'dana' => 0,
                    'anggaran' => 140000000,
                    'deskripsi' => 'Pembuatan drainase beton permanen untuk mencegah genangan air saat musim hujan.'
                ]
            ]);
        }

        // Fetch Documents from dokumen table or fallback
        $documents = Dokumen::latest()->take(4)->get();
        if ($documents->isEmpty()) {
            $documents = collect([
                (object)[
                    'id' => 1,
                    'nama' => 'Laporan Pertanggungjawaban APBDes TA 2025.pdf',
                    'slug' => 'lpj-apbdes-2025',
                    'keterangan' => 'Laporan Pertanggungjawaban APBDes Tahun Anggaran 2025',
                    'file_path' => '#',
                    'created_at' => now()->subMonths(2)
                ],
                (object)[
                    'id' => 2,
                    'nama' => 'Rencana Kerja Pemerintah Desa (RKPDes) 2026.pdf',
                    'slug' => 'rkpdes-2026',
                    'keterangan' => 'Rencana program pembangunan desa untuk tahun 2026',
                    'file_path' => '#',
                    'created_at' => now()->subMonths(1)
                ],
                (object)[
                    'id' => 3,
                    'nama' => 'Infografis Transparansi APBDes Realisasi 2026.pdf',
                    'slug' => 'infografis-apbdes-2026',
                    'keterangan' => 'Infografis sebaran dana APBDes realisasi berjalan 2026',
                    'file_path' => '#',
                    'created_at' => now()
                ]
            ]);
        }

        $years = Apbdes::distinct()->pluck('tahun_anggaran')->toArray();
        if (empty($years)) {
            $years = [2026, 2025, 2024];
        }

        // Calculate progress total
        $realizationProgress = $totalBelanja > 0 ? round(($totalBelanjaRealisasi / $totalBelanja) * 100, 1) : 0;

        return view('public.transparansi.index', compact(
            'selectedYear', 'totalPendapatan', 'totalPendapatanRealisasi', 'totalBelanja', 
            'totalBelanjaRealisasi', 'categories', 'realizationData', 'programs', 
            'documents', 'years', 'realizationProgress'
        ));
    }
}
