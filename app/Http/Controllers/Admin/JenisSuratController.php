<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Services\Pelayanan\JenisSuratService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JenisSuratController extends Controller
{
    protected $service;

    public function __construct(JenisSuratService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        Gate::authorize('jenis-surat.view');

        $items = $this->service->getAdminList();

        return view('admin.jenis-surat.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('jenis-surat.create');

        return view('admin.jenis-surat.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('jenis-surat.create');

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:20|unique:jenis_surat,kode',
            'template' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'is_active' => 'boolean',
            'urutan' => 'integer',
        ]);

        $this->service->create($validated);

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        Gate::authorize('jenis-surat.edit');

        $item = $this->service->findByIdOrFail($id);

        return view('admin.jenis-surat.edit', compact('item'));
    }

    public function update(Request $request, int $id)
    {
        Gate::authorize('jenis-surat.edit');

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:20|unique:jenis_surat,kode,' . $id,
            'template' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'is_active' => 'boolean',
            'urutan' => 'integer',
        ]);

        $this->service->update($id, $validated);

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        Gate::authorize('jenis-surat.delete');

        $this->service->delete($id);

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil dihapus.');
    }
}
