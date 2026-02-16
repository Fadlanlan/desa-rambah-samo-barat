<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('public.umkm.index', compact('umkms'));
    }
}
