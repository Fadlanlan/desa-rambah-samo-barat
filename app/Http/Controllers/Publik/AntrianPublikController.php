<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Services\Pelayanan\AntrianService;
use Illuminate\Http\Request;
use Exception;

class AntrianPublikController extends Controller
{
    protected $antrianService;

    public function __construct(AntrianService $antrianService)
    {
        $this->antrianService = $antrianService;
    }

    /**
     * Show booking form.
     */
    public function create()
    {
        return view('public.antrian.create');
    }

    /**
     * Store new booking.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengunjung' => 'required|string|max:255',
            'nik_pengunjung' => 'nullable|string|max:16',
            'kontak_pengunjung' => 'required|string|max:20',
            'keperluan' => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'jam_kunjungan' => 'required|string',
            'captcha' => 'required|captcha'
        ]);

        try {
            $antrian = $this->antrianService->bookQueue($validated);
            return redirect()->route('public.antrian.success', $antrian->token_akses)
                ->with('success', 'Antrian berhasil dibooking!');
        }
        catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Success page.
     */
    public function success($token)
    {
        $antrian = $this->antrianService->getStatusByToken($token);
        if (!$antrian) {
            abort(404);
        }

        return view('public.antrian.success', compact('antrian'));
    }

    /**
     * Check status.
     */
    public function checkStatus(Request $request)
    {
        $token = $request->get('token');
        $antrian = null;
        if ($token) {
            $antrian = $this->antrianService->getStatusByToken($token);
        }

        return view('public.antrian.check', compact('antrian', 'token'));
    }
}
