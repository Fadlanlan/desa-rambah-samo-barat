<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Services\Pelayanan\SuratService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SuratPublikController extends Controller
{
    protected $suratService;

    public function __construct(SuratService $suratService)
    {
        $this->suratService = $suratService;
    }

    /**
     * Show the public letter request form.
     */
    public function create()
    {
        $jenisSurat = JenisSurat::where('is_active', true)->get();
        return view('public.surat.create', compact('jenisSurat'));
    }

    /**
     * Store a new letter request from the public.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'size:16'],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_surat_id' => ['required', 'exists:jenis_surat,id'],
            'keperluan' => ['required', 'string', 'min:5'],
        ]);

        // Find resident by NIK hash (Blind Index)
        $nikHash = hash_hmac('sha256', $validated['nik'], config('app.key'));
        $penduduk = Penduduk::where('nik_hash', $nikHash)->first();

        if (!$penduduk) {
            return back()->withInput()->with('error', 'NIK tidak ditemukan dalam database kependudukan desa.');
        }

        // Optional: Check if name matches (basic verification)
        if (strtolower($penduduk->nama) !== strtolower($validated['nama'])) {
            return back()->withInput()->with('error', 'Kombinasi NIK dan Nama tidak sesuai.');
        }

        try {
            $data = [
                'penduduk_id' => $penduduk->id,
                'jenis_surat_id' => $validated['jenis_surat_id'],
                'keperluan' => $validated['keperluan'],
                'keterangan' => 'Diajukan secara mandiri melalui website publik.',
            ];

            $this->suratService->submitRequest($data);

            return redirect()->route('public.surat.success')
                ->with('success_nik', $validated['nik']);
        }
        catch (\Exception $e) {
            Log::error('Public Surat Request Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi nanti.');
        }
    }

    /**
     * Show success page.
     */
    public function success()
    {
        return view('public.surat.success');
    }
}
