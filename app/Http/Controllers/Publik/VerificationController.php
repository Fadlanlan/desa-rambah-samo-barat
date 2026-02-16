<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Verify the authenticity of a letter via QR code.
     */
    public function verify(string $uuid)
    {
        $surat = Surat::where('uuid', $uuid)
            ->with(['jenisSurat', 'penduduk', 'processor'])
            ->firstOrFail();

        return view('public.surat.verify', compact('surat'));
    }
}
