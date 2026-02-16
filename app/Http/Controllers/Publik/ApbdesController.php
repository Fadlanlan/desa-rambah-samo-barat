<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Apbdes;
use Illuminate\Http\Request;

class ApbdesController extends Controller
{
    public function index()
    {
        $apbdes = Apbdes::where('is_active', true)
            ->orderBy('title', 'desc')
            ->get();

        return view('public.apbdes.index', compact('apbdes'));
    }
}
