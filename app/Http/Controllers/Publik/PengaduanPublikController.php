<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Services\Pelayanan\PengaduanService;
use App\Repositories\Interfaces\PengaduanRepositoryInterface;
use Illuminate\Http\Request;

class PengaduanPublikController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(PengaduanService $service, PengaduanRepositoryInterface $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function create()
    {
        return view('public.pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'kontak_pelapor' => 'required|string|max:50',
            'kategori' => 'required|string',
            'judul' => 'required|string|max:200',
            'isi' => 'required|string|min:20',
            'prioritas' => 'required|in:rendah,sedang,tinggi,urgent',
            'bukti_file' => 'nullable|image|max:2048', // 2MB max
            'captcha' => 'required|captcha'
        ]);

        try {
            $complaint = $this->service->submitComplaint($request->all());

            return redirect()->route('public.pengaduan.success', $complaint->nomor_tiket)
                ->with('success', 'Aduan Anda telah berhasil dikirim.');
        }
        catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim aduan: ' . $e->getMessage());
        }
    }

    public function success(string $ticket)
    {
        return view('public.pengaduan.success', compact('ticket'));
    }

    public function checkStatus(Request $request)
    {
        $ticket = $request->ticket;
        $complaint = null;

        if ($ticket) {
            $complaint = $this->repository->findByTicketNumber($ticket);
        }

        return view('public.pengaduan.check', compact('complaint', 'ticket'));
    }
}
