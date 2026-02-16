<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::where('is_active', true)
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(10);

        return view('public.agenda.index', compact('agendas'));
    }

    public function show($id)
    {
        $agenda = Agenda::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        return view('public.agenda.show', compact('agenda'));
    }
}
