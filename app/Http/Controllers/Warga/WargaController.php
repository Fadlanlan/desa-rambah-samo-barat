<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warga\WargaCreateRequest;
use App\Services\Warga\WargaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exports\WargaExport;
use Maatwebsite\Excel\Facades\Excel;

class WargaController extends Controller
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
        $this->authorize('penduduk.view');

        $perPage = $request->get('limit', 15);
        $filters = $request->only(['search', 'status']);
        $warga = $this->wargaService->getListPenduduk($perPage, $filters);

        return view('warga.index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('penduduk.create');
        return view('warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WargaCreateRequest $request)
    {
        // Permission checked in WargaCreateRequest

        try {
            $this->wargaService->createPenduduk($request->validated());
            return redirect()->route('warga.index')
                ->with('success', 'Data penduduk berhasil ditambahkan.');
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
        $this->authorize('penduduk.view');
        $penduduk = $this->wargaService->getPendudukDetail($id);

        if (!$penduduk) {
            abort(404);
        }

        return view('warga.show', compact('penduduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('penduduk.edit');
        $penduduk = $this->wargaService->getPendudukDetail($id);

        if (!$penduduk) {
            abort(404);
        }

        return view('warga.edit', compact('penduduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('penduduk.edit');

        $validated = $request->validate([
            'nik' => ['required', 'string', 'size:16', 'unique:penduduk,nik,' . $id],
            'nama' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'agama' => ['nullable', 'string', 'max:50'],
            'status_perkawinan' => ['nullable', 'string', 'max:50'],
            'pekerjaan' => ['nullable', 'string', 'max:100'],
            'pendidikan_terakhir' => ['nullable', 'string', 'max:100'],
            'kewarganegaraan' => ['nullable', 'string', 'max:5'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'keluarga_id' => ['nullable', 'exists:keluarga,id'],
            'status' => ['required', 'in:aktif,meninggal,pindah,hilang'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('penduduk', 'public');
            $validated['foto'] = $path;
        }

        try {
            $this->wargaService->updatePenduduk($id, $validated);
            return redirect()->route('warga.show', $id)
                ->with('success', 'Data penduduk berhasil diperbarui.');
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
        $this->authorize('penduduk.delete');

        try {
            $this->wargaService->deletePenduduk($id);
            return redirect()->route('warga.index')
                ->with('success', 'Data penduduk berhasil dihapus.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove all penduduk data.
     */
    public function destroyAll()
    {
        $this->authorize('penduduk.delete');

        try {
            \Illuminate\Support\Facades\DB::transaction(function () {
                \App\Models\Penduduk::query()->forceDelete();
            });

            return redirect()->route('warga.index')
                ->with('success', 'Seluruh data penduduk berhasil dihapus.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    /**
     * Export penduduk data to Excel.
     */
    public function export()
    {
        return Excel::download(new WargaExport, 'data-penduduk-' . date('Y-m-d') . '.xlsx');
    }
}
