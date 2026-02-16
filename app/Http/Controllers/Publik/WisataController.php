<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index()
    {
        $wisatas = Wisata::where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('public.wisata.index', compact('wisatas'));
    }

    public function show($slug)
    {
        $wisata = Wisata::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('public.wisata.show', compact('wisata'));
    }
}
