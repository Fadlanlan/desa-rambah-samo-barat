<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Apbdes;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class ApbdesController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->get('year', 2026);
        $search = $request->get('search');
        $sortBy = $request->get('sort_by', 'jenis');
        $sortOrder = $request->get('sort_order', 'asc');

        // Check if database has data for this year
        $hasData = Apbdes::where('tahun_anggaran', $selectedYear)->exists();

        if ($hasData) {
            // Aggregate totals
            $totalPendapatan = Apbdes::where('tahun_anggaran', $selectedYear)->where('jenis', 'pendapatan')->sum('anggaran');
            $totalBelanja = Apbdes::where('tahun_anggaran', $selectedYear)->where('jenis', 'belanja')->sum('anggaran');
            $totalPembiayaan = Apbdes::where('tahun_anggaran', $selectedYear)->where('jenis', 'pembiayaan')->sum('anggaran');

            $danaDesa = Apbdes::where('tahun_anggaran', $selectedYear)->where('sumber_dana', 'like', '%Dana Desa%')->orWhere('sumber_dana', 'like', '%DD%')->sum('anggaran');
            $pad = Apbdes::where('tahun_anggaran', $selectedYear)->where('sumber_dana', 'like', '%PAD%')->orWhere('sumber_dana', 'like', '%Asli Desa%')->sum('anggaran');
            $bantuanPemerintah = Apbdes::where('tahun_anggaran', $selectedYear)->where(function($q) {
                $q->where('sumber_dana', 'like', '%Provinsi%')
                  ->orWhere('sumber_dana', 'like', '%Prov%')
                  ->orWhere('sumber_dana', 'like', '%Bantuan%');
            })->sum('anggaran');

            $sisaAnggaran = $totalPendapatan - $totalBelanja;

            // Detail table items query
            $query = Apbdes::where('tahun_anggaran', $selectedYear);
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('uraian', 'like', "%{$search}%")
                      ->orWhere('kategori', 'like', "%{$search}%")
                      ->orWhere('sub_kategori', 'like', "%{$search}%");
                });
            }

            $items = $query->orderBy($sortBy, $sortOrder)->paginate(10)->withQueryString();

            // Program Detail with realistic mappings
            $programs = Apbdes::where('tahun_anggaran', $selectedYear)
                ->where('jenis', 'belanja')
                ->get()
                ->map(function ($item, $index) {
                    $progress = $item->anggaran > 0 ? round(($item->realisasi / $item->anggaran) * 100) : 0;
                    return (object)[
                        'id' => $item->id,
                        'nama' => $item->uraian,
                        'lokasi' => $item->sub_kategori ?? 'Wilayah Desa',
                        'dana' => $item->anggaran,
                        'realisasi' => $item->realisasi,
                        'pj' => 'Kepala Urusan Pembangunan',
                        'progress' => $progress,
                        'foto' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&auto=format&fit=cover&w=400&q=80',
                    ];
                });
        } else {
            // High-Fidelity Mock APBDes for 2026
            $totalPendapatan = 2455000000;
            $totalBelanja = 2475000000;
            $danaDesa = 1250000000;
            $pad = 150000000;
            $bantuanPemerintah = 970000000; // ADD (850M) + Provinsi (120M)
            $sisaAnggaran = -20000000; // Covered by Silpa

            // Prepare mock list for detail table with pagination
            $mockList = collect([
                (object)[
                    'id' => 1,
                    'jenis' => 'Pendapatan',
                    'kategori' => 'Transfer APBN',
                    'sub_kategori' => 'Dana Desa (DD)',
                    'uraian' => 'Penerimaan Dana Desa TA 2026',
                    'anggaran' => 1250000000,
                    'realisasi' => 1250000000,
                    'sumber_dana' => 'APBN',
                    'keterangan' => 'Sektor Pembangunan dan Pemberdayaan'
                ],
                (object)[
                    'id' => 2,
                    'jenis' => 'Pendapatan',
                    'kategori' => 'Transfer APBD',
                    'sub_kategori' => 'Alokasi Dana Desa (ADD)',
                    'uraian' => 'Alokasi Dana Desa dari Kabupaten Rokan Hulu',
                    'anggaran' => 850000000,
                    'realisasi' => 850000000,
                    'sumber_dana' => 'APBD Kabupaten',
                    'keterangan' => 'Sektor Siltap Perangkat & Operasional Kantor'
                ],
                (object)[
                    'id' => 3,
                    'jenis' => 'Pendapatan',
                    'kategori' => 'Pendapatan Asli',
                    'sub_kategori' => 'PADes',
                    'uraian' => 'Hasil Bagi BUMDes Samo Barat Mandiri',
                    'anggaran' => 150000000,
                    'realisasi' => 120000000,
                    'sumber_dana' => 'BUMDes',
                    'keterangan' => 'Sektor retribusi unit pasar desa'
                ],
                (object)[
                    'id' => 4,
                    'jenis' => 'Belanja',
                    'kategori' => 'Infrastruktur',
                    'sub_kategori' => 'Semenisasi Jalan',
                    'uraian' => 'Pembangunan Jalan Semenisasi Dusun I',
                    'anggaran' => 185000000,
                    'realisasi' => 185000000,
                    'sumber_dana' => 'Dana Desa',
                    'keterangan' => 'Selesai 100%'
                ],
                (object)[
                    'id' => 5,
                    'jenis' => 'Belanja',
                    'kategori' => 'Kesehatan',
                    'sub_kategori' => 'Stunting',
                    'uraian' => 'Pemberian Makanan Tambahan Balita & Posyandu',
                    'anggaran' => 45000000,
                    'realisasi' => 45000000,
                    'sumber_dana' => 'Dana Desa',
                    'keterangan' => 'Selesai 100%'
                ],
                (object)[
                    'id' => 6,
                    'jenis' => 'Belanja',
                    'kategori' => 'Infrastruktur',
                    'sub_kategori' => 'Jembatan Cor',
                    'uraian' => 'Rehabilitasi Jembatan Penghubung Dusun III',
                    'anggaran' => 280000000,
                    'realisasi' => 210000000,
                    'sumber_dana' => 'Dana Desa',
                    'keterangan' => 'Berjalan 75%'
                ],
                (object)[
                    'id' => 7,
                    'jenis' => 'Belanja',
                    'kategori' => 'Sosial',
                    'sub_kategori' => 'Bansos Tunai',
                    'uraian' => 'Penyaluran BLT-DD Tahap I & II',
                    'anggaran' => 240000000,
                    'realisasi' => 120000000,
                    'sumber_dana' => 'Dana Desa',
                    'keterangan' => 'Berjalan 50%'
                ],
                (object)[
                    'id' => 8,
                    'jenis' => 'Belanja',
                    'kategori' => 'Ketahanan Pangan',
                    'sub_kategori' => 'Perikanan Darat',
                    'uraian' => 'Pelatihan Budidaya Ikan Nila Desa',
                    'anggaran' => 50000000,
                    'realisasi' => 42500000,
                    'sumber_dana' => 'Dana Desa',
                    'keterangan' => 'Berjalan 85%'
                ],
                (object)[
                    'id' => 9,
                    'jenis' => 'Belanja',
                    'kategori' => 'Pemerintahan',
                    'sub_kategori' => 'Siltap',
                    'uraian' => 'Pembayaran Penghasilan Tetap Kepala Desa & Perangkat',
                    'anggaran' => 540000000,
                    'realisasi' => 540000000,
                    'sumber_dana' => 'ADD',
                    'keterangan' => 'Selesai 100%'
                ],
                (object)[
                    'id' => 10,
                    'jenis' => 'Belanja',
                    'kategori' => 'Pendidikan',
                    'sub_kategori' => 'Gedung PAUD',
                    'uraian' => 'Penyediaan Insentif Pendidik PAUD Kasih Ibu',
                    'anggaran' => 60000000,
                    'realisasi' => 50000000,
                    'sumber_dana' => 'Dana Desa',
                    'keterangan' => 'Selesai 100%'
                ]
            ]);

            if ($search) {
                $mockList = $mockList->filter(function ($item) use ($search) {
                    return stripos($item->uraian, $search) !== false || 
                           stripos($item->kategori, $search) !== false ||
                           stripos($item->jenis, $search) !== false;
                });
            }

            // Sort
            if ($sortBy === 'jenis') {
                $mockList = $sortOrder === 'asc' ? $mockList->sortBy('jenis') : $mockList->sortByDesc('jenis');
            } elseif ($sortBy === 'anggaran') {
                $mockList = $sortOrder === 'asc' ? $mockList->sortBy('anggaran') : $mockList->sortByDesc('anggaran');
            }

            // Mock pagination using length aware paginator
            $currentPage = request()->get('page', 1);
            $perPage = 6;
            $currentItems = $mockList->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $items = new \Illuminate\Pagination\LengthAwarePaginator(
                $currentItems, 
                $mockList->count(), 
                $perPage, 
                $currentPage, 
                ['path' => request()->url(), 'query' => request()->query()]
            );

            // Program Detail with fallback
            $programs = collect([
                (object)[
                    'id' => 4,
                    'nama' => 'Pembangunan Jalan Semenisasi Dusun I',
                    'lokasi' => 'Dusun I RT 03',
                    'dana' => 185000000,
                    'realisasi' => 185000000,
                    'pj' => 'Bpk. Ahmad Fauzi (Kaur Pembangunan)',
                    'progress' => 100,
                    'foto' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&auto=format&fit=cover&w=400&q=80',
                ],
                (object)[
                    'id' => 6,
                    'nama' => 'Rehabilitasi Jembatan Penghubung Dusun III',
                    'lokasi' => 'Dusun III RT 10',
                    'dana' => 280000000,
                    'realisasi' => 210000000,
                    'pj' => 'Bpk. Ahmad Fauzi (Kaur Pembangunan)',
                    'progress' => 75,
                    'foto' => 'https://images.unsplash.com/photo-1513828729007-62f0259e8743?ixlib=rb-4.0.3&auto=format&fit=cover&w=400&q=80',
                ],
                (object)[
                    'id' => 7,
                    'nama' => 'Penyaluran BLT-DD Tahap I & II',
                    'lokasi' => 'Aula Kantor Desa',
                    'dana' => 240000000,
                    'realisasi' => 120000000,
                    'pj' => 'Ibu Siti Aminah (Kasi Pelayanan)',
                    'progress' => 50,
                    'foto' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=cover&w=400&q=80',
                ],
                (object)[
                    'id' => 8,
                    'nama' => 'Pelatihan Budidaya Ikan Nila Desa',
                    'lokasi' => 'Dusun IV RT 12',
                    'dana' => 50000000,
                    'realisasi' => 42500000,
                    'pj' => 'Bpk. H. Supardi (Kasi Pemberdayaan)',
                    'progress' => 85,
                    'foto' => 'https://images.unsplash.com/photo-1534080391025-0979e8304b2b?ixlib=rb-4.0.3&auto=format&fit=cover&w=400&q=80',
                ]
            ]);
        }

        // Dropdowns and lists
        $years = Apbdes::distinct()->pluck('tahun_anggaran')->toArray();
        if (empty($years)) {
            $years = [2026, 2025, 2024];
        }

        $documents = Dokumen::latest()->take(4)->get();
        if ($documents->isEmpty()) {
            $documents = collect([
                (object)[
                    'id' => 1,
                    'nama' => 'Peta Realisasi Fisik APBDes TA 2025.xlsx',
                    'slug' => 'peta-realisasi-2025',
                    'keterangan' => 'Laporan excel rekap realisasi pembangunan 2025',
                    'file_path' => '#',
                    'created_at' => now()->subMonths(3)
                ],
                (object)[
                    'id' => 2,
                    'nama' => 'Rencana Pembangunan Jangka Menengah Desa (RPJMDes).pdf',
                    'slug' => 'rpjmdes-samobarat',
                    'keterangan' => 'Rencana jangka menengah pembangunan desa',
                    'file_path' => '#',
                    'created_at' => now()->subYears(1)
                ],
                (object)[
                    'id' => 3,
                    'nama' => 'Dokumen APBDes Murni Tahun Anggaran 2026.pdf',
                    'slug' => 'apbdes-murni-2026',
                    'keterangan' => 'Peraturan Desa tentang APBDes Murni 2026',
                    'file_path' => '#',
                    'created_at' => now()
                ]
            ]);
        }

        // Pembangunan gallery mock up
        $gallery = collect([
            (object)['title' => 'Semenisasi Dusun I', 'img' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&auto=format&fit=cover&w=600&q=80', 'kategori' => 'Infrastruktur'],
            (object)['title' => 'Rehabilitasi Jembatan', 'img' => 'https://images.unsplash.com/photo-1513828729007-62f0259e8743?ixlib=rb-4.0.3&auto=format&fit=cover&w=600&q=80', 'kategori' => 'Infrastruktur'],
            (object)['title' => 'Posyandu Terpadu Stunting', 'img' => 'https://images.unsplash.com/photo-1502740479796-62dd934c2a3b?ixlib=rb-4.0.3&auto=format&fit=cover&w=600&q=80', 'kategori' => 'Kesehatan'],
            (object)['title' => 'Pelatihan Budidaya Ikan', 'img' => 'https://images.unsplash.com/photo-1534080391025-0979e8304b2b?ixlib=rb-4.0.3&auto=format&fit=cover&w=600&q=80', 'kategori' => 'Pemberdayaan'],
            (object)['title' => 'Penyaluran BLT Dana Desa', 'img' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=cover&w=600&q=80', 'kategori' => 'Sosial'],
            (object)['title' => 'Pasar Tradisional Desa', 'img' => 'https://images.unsplash.com/photo-1533900298318-6b8da08a523e?ixlib=rb-4.0.3&auto=format&fit=cover&w=600&q=80', 'kategori' => 'UMKM']
        ]);

        return view('public.apbdes.index', compact(
            'selectedYear', 'totalPendapatan', 'totalBelanja', 'danaDesa', 'pad', 
            'bantuanPemerintah', 'sisaAnggaran', 'items', 'programs', 'years', 
            'documents', 'gallery', 'search', 'sortBy', 'sortOrder'
        ));
    }
}
