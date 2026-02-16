<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Services\Warga\WargaService;
use Illuminate\Http\Request;

class KeluargaController extends Controller
{
    protected $wargaService;

    public function __construct(WargaService $wargaService)
    {
        $this->wargaService = $wargaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('keluarga.view');

        $perPage = $request->get('limit', 15);
        $filters = $request->only(['search', 'dusun']);
        $keluarga = $this->wargaService->getListKeluarga($perPage, $filters);

        return view('warga.keluarga.index', compact('keluarga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('keluarga.create');
        return view('warga.keluarga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('keluarga.create');

        $data = $request->validate([
            'no_kk' => ['required', 'string', 'size:16', 'unique:keluarga,no_kk'],
            'kepala_keluarga' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'dusun' => ['nullable', 'string', 'max:100'],
            'kelurahan' => ['nullable', 'string', 'max:100'],
            'kecamatan' => ['nullable', 'string', 'max:100'],
            'kabupaten' => ['nullable', 'string', 'max:100'],
            'provinsi' => ['nullable', 'string', 'max:100'],
            'kode_pos' => ['nullable', 'string', 'max:10'],
        ]);

        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        try {
            $this->wargaService->createKeluarga($data);
            return redirect()->route('keluarga.index')
                ->with('success', 'Data keluarga berhasil ditambahkan.');
        }
        catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('keluarga.view');
        $keluarga = $this->wargaService->getKeluargaDetail($id);

        if (!$keluarga) {
            abort(404);
        }

        return view('warga.keluarga.show', compact('keluarga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('keluarga.edit');
        $keluarga = $this->wargaService->getKeluargaDetail($id);

        if (!$keluarga) {
            abort(404);
        }

        return view('warga.keluarga.edit', compact('keluarga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('keluarga.edit');

        $data = $request->validate([
            'kepala_keluarga' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'dusun' => ['nullable', 'string', 'max:100'],
            'kode_pos' => ['nullable', 'string', 'max:10'],
        ]);

        $data['updated_by'] = auth()->id();

        try {
            $this->wargaService->updateKeluarga($id, $data);
            return redirect()->route('keluarga.show', $id)
                ->with('success', 'Data keluarga berhasil diperbarui.');
        }
        catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('keluarga.delete');

        try {
            $this->wargaService->deleteKeluarga($id);
            return redirect()->route('keluarga.index')
                ->with('success', 'Data keluarga berhasil dihapus.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove all keluarga data.
     */
    public function destroyAll()
    {
        $this->authorize('keluarga.delete');

        try {
            \Illuminate\Support\Facades\DB::transaction(function () {
                // Delete dependants (Penduduk) first? Or let database constraints handle it?
                // Given the risk, we should probably force delete Penduduk first if they belong to existing families,
                // but usually user should delete Penduduk first.
                // However, since we have cascading deletes or we want to clear everything:

                // Option 1: Just delete families. If constraints are set to CASCADE, residents will be deleted.
                // If SET NULL, they become orphaned.
                // Let's check constraints. migration says: $table->foreignId('keluarga_id')->nullable()->constrained('keluarga')->nullOnDelete();
                // So residents will be kept but with null family_id. This is safer.

                \App\Models\Keluarga::query()->forceDelete();
            });

            return redirect()->route('keluarga.index')
                ->with('success', 'Seluruh data kartu keluarga berhasil dihapus.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
