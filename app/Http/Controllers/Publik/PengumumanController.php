<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::where('is_active', true)
            ->latest()
            ->paginate(10);

        return view('public.pengumuman.index', compact('pengumuman'));
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        return view('public.pengumuman.show', compact('pengumuman'));
    }
}
