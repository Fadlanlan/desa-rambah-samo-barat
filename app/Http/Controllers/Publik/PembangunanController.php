<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Apbdes;
use Illuminate\Http\Request;

class PembangunanController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->get('year', date('Y'));
        $kategori = $request->get('kategori', 'Semua');

        // Filter by year if in db
        $years = \App\Models\Pembangunan::distinct()->orderBy('tahun', 'desc')->pluck('tahun')->toArray();
        if (empty($years)) {
            $years = [date('Y')];
        }

        // Apply filters
        $query = \App\Models\Pembangunan::where('tahun', $selectedYear);
        if ($kategori !== 'Semua') {
            $query->where('kategori', $kategori);
        }
        $pembangunans = $query->latest()->get();

        $kategoris = ['Semua', 'Jalan', 'Jembatan', 'Irigasi', 'Gedung', 'Sosial'];

        return view('public.pembangunan.index', compact(
            'pembangunans', 'selectedYear', 'kategori', 'kategoris', 'years'
        ));
    }
}
