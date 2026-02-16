<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::where('is_public', true)
            ->latest()
            ->paginate(15);

        return view('public.dokumen.index', compact('dokumen'));
    }
}
