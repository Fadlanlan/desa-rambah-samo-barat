<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apbdes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ApbdesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('apbdes.view');

        $query = Apbdes::query();

        if ($request->has('year')) {
            $query->where('tahun_anggaran', $request->year);
        }
        else {
            // Default to current year or latest year in DB
            $latestYear = Apbdes::max('tahun_anggaran') ?? date('Y');
            $query->where('tahun_anggaran', $latestYear);
        }

        if ($request->has('search')) {
            $query->where('uraian', 'like', '%' . $request->search . '%');
        }

        $items = $query->orderBy('tahun_anggaran', 'desc')
            ->orderBy('jenis', 'asc')
            ->paginate(20);

        return view('admin.apbdes.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('apbdes.create');
        return view('admin.apbdes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('apbdes.create');

        $validated = $request->validate([
            'tahun_anggaran' => 'required|integer|min:2000|max:2100',
            'jenis' => 'required|string|in:pendapatan,belanja,pembiayaan',
            'kategori' => 'nullable|string|max:100',
            'sub_kategori' => 'nullable|string|max:100',
            'uraian' => 'required|string|max:255',
            'anggaran' => 'required|numeric|min:0',
            'realisasi' => 'required|numeric|min:0',
            'sumber_dana' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        try {
            Apbdes::create($validated);
            return redirect()->route('apbdes.index', ['year' => $validated['tahun_anggaran']])
                ->with('success', 'Data APBDes berhasil ditambahkan.');
        }
        catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('apbdes.edit');
        $item = Apbdes::findOrFail($id);
        return view('admin.apbdes.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('apbdes.edit');

        $item = Apbdes::findOrFail($id);

        $validated = $request->validate([
            'tahun_anggaran' => 'required|integer|min:2000|max:2100',
            'jenis' => 'required|string|in:pendapatan,belanja,pembiayaan',
            'kategori' => 'nullable|string|max:100',
            'sub_kategori' => 'nullable|string|max:100',
            'uraian' => 'required|string|max:255',
            'anggaran' => 'required|numeric|min:0',
            'realisasi' => 'required|numeric|min:0',
            'sumber_dana' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $item->update($validated);
            return redirect()->route('apbdes.index', ['year' => $validated['tahun_anggaran']])
                ->with('success', 'Data APBDes berhasil diperbarui.');
        }
        catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('apbdes.delete');

        try {
            $item = Apbdes::findOrFail($id);
            $year = $item->tahun_anggaran;
            $item->delete();
            return redirect()->route('apbdes.index', ['year' => $year])
                ->with('success', 'Data APBDes berhasil dihapus.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
