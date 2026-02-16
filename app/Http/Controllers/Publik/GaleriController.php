<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galleries = Galeri::where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('public.galeri.index', compact('galleries'));
    }
}
