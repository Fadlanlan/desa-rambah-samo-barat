<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Village;
use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    /**
     * Display the village profile.
     */
    public function index()
    {
        $village = Village::first() ?? new Village();
        return view('public.profil.index', compact('village'));
    }

    /**
     * Display Visi & Misi.
     */
    public function visiMisi()
    {
        $village = Village::first() ?? new Village();
        return view('public.profil.visi-misi', compact('village'));
    }

    /**
     * Display Struktur Organisasi.
     */
    public function struktur()
    {
        $village = Village::first() ?? new Village();
        return view('public.profil.struktur', compact('village'));
    }

    /**
     * Display Sejarah Desa.
     */
    public function sejarah()
    {
        $village = Village::first() ?? new Village();
        return view('public.profil.sejarah', compact('village'));
    }
}
