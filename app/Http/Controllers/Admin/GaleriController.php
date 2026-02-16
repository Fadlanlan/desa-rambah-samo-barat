<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('galeri.view');

        $query = Galeri::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $items = $query->latest()->paginate(12);

        return view('admin.galeri.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('galeri.create');
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('galeri.create');

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_path' => 'required|file|image|max:5120', // Max 5MB
            'kategori' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['tipe'] = 'foto'; // Default to foto for now

        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('galeri', 'public');
            $validated['file_path'] = $path;
        }

        try {
            Galeri::create($validated);
            return redirect()->route('galeri.index')
                ->with('success', 'Galeri berhasil ditambahkan.');
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
        Gate::authorize('galeri.edit');
        $item = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('galeri.edit');

        $item = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|image|max:5120',
            'kategori' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('file_path')) {
            // Delete old file
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }

            $path = $request->file('file_path')->store('galeri', 'public');
            $validated['file_path'] = $path;
        }

        try {
            $item->update($validated);
            return redirect()->route('galeri.index')
                ->with('success', 'Galeri berhasil diperbarui.');
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
        Gate::authorize('galeri.delete');

        try {
            $item = Galeri::findOrFail($id);

            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }

            $item->delete();
            return redirect()->route('galeri.index')
                ->with('success', 'Galeri berhasil dihapus.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
