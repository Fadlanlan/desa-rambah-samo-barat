<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Pelayanan\PengaduanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PengaduanController extends Controller
{
    protected $service;

    public function __construct(PengaduanService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        Gate::authorize('pengaduan.view'); // Reusing letters permission or generic staff access

        $items = $this->service->paginateAdmin($request->all());

        return view('admin.pengaduan.index', compact('items'));
    }

    public function show(int $id)
    {
        Gate::authorize('pengaduan.view');

        $item = $this->service->findById($id);

        return view('admin.pengaduan.show', compact('item'));
    }

    public function process(int $id)
    {
        Gate::authorize('pengaduan.process');

        try {
            $this->service->process($id);
            return redirect()->back()->with('success', 'Aduan telah ditandai sedang diproses.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function reply(Request $request, int $id)
    {
        Gate::authorize('pengaduan.process');

        $request->validate([
            'balasan' => 'required|string|min:5',
            'status' => 'required|in:selesai,ditolak',
        ]);

        try {
            $this->service->reply($id, $request->balasan, $request->status);
            return redirect()->route('pengaduan.index')->with('success', 'Balasan telah dikirim dan status diperbarui.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    /**
     * Remove all complaints.
     */
    public function destroyAll()
    {
        Gate::authorize('pengaduan.delete'); // Or pengaduan.manage if delete permission doesn't exist. Using pengaduan.delete as planned.

        try {
            // Using logic similar to other controllers
            \App\Models\Pengaduan::truncate();

            return redirect()->route('pengaduan.index')
                ->with('success', 'Seluruh data aduan berhasil dibersihkan.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
