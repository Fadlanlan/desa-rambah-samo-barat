<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class WisataController extends Controller
{
    public function index()
    {
        Gate::authorize('wisata.view');
        $wisatas = Wisata::latest()->paginate(10);
        return view('admin.wisata.index', compact('wisatas'));
    }

    public function create()
    {
        Gate::authorize('wisata.create');
        return view('admin.wisata.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('wisata.create');
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'lokasi' => 'nullable|max:255',
            'harga_tiket' => 'nullable|max:255',
            'jam_operasional' => 'nullable|max:255',
            'kontak' => 'nullable|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('wisata', 'public');
        }

        Wisata::create($validated);

        return redirect()->route('wisata.index')->with('success', 'Wisata berhasil ditambahkan.');
    }

    public function edit(Wisata $wisata)
    {
        Gate::authorize('wisata.edit');
        return view('admin.wisata.edit', compact('wisata'));
    }

    public function update(Request $request, Wisata $wisata)
    {
        Gate::authorize('wisata.edit');
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'lokasi' => 'nullable|max:255',
            'harga_tiket' => 'nullable|max:255',
            'jam_operasional' => 'nullable|max:255',
            'kontak' => 'nullable|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($wisata->gambar) {
                Storage::delete('public/' . $wisata->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('wisata', 'public');
        }

        $wisata->update($validated);

        return redirect()->route('wisata.index')->with('success', 'Wisata berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        Gate::authorize('wisata.delete');
        try {
            $wisata = Wisata::findOrFail($id);

            if ($wisata->gambar && Storage::disk('public')->exists($wisata->gambar)) {
                Storage::disk('public')->delete($wisata->gambar);
            }

            $wisata->forceDelete();

            return redirect()->route('wisata.index')->with('success', 'Wisata berhasil dihapus.');
        }
        catch (\Exception $e) {
            return redirect()->route('wisata.index')->with('error', 'Gagal menghapus wisata: ' . $e->getMessage());
        }
    }
}
