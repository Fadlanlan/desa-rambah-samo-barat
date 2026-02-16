<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('dokumen.view');

        $query = Dokumen::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $items = $query->latest()->paginate(15);

        return view('admin.dokumen.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('dokumen.create');
        return view('admin.dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('dokumen.create');

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_path' => 'required|file|max:10240', // Max 10MB
            'kategori' => 'nullable|string|max:50',
            'is_public' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['download_count'] = 0;

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('dokumen', 'public');

            $validated['file_path'] = $path;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_type'] = $file->getClientMimeType();
            $validated['file_size'] = $file->getSize();
        }

        try {
            Dokumen::create($validated);
            return redirect()->route('dokumen.index')
                ->with('success', 'Dokumen berhasil diupload.');
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
        Gate::authorize('dokumen.edit');
        $item = Dokumen::findOrFail($id);
        return view('admin.dokumen.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('dokumen.edit');

        $item = Dokumen::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|max:10240',
            'kategori' => 'nullable|string|max:50',
            'is_public' => 'boolean',
        ]);

        if ($request->hasFile('file_path')) {
            // Delete old file
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }

            $file = $request->file('file_path');
            $path = $file->store('dokumen', 'public');

            $validated['file_path'] = $path;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_type'] = $file->getClientMimeType();
            $validated['file_size'] = $file->getSize();
        }

        try {
            $item->update($validated);
            return redirect()->route('dokumen.index')
                ->with('success', 'Dokumen berhasil diperbarui.');
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
        Gate::authorize('dokumen.delete');

        try {
            $item = Dokumen::findOrFail($id);

            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }

            $item->delete();
            return redirect()->route('dokumen.index')
                ->with('success', 'Dokumen berhasil dihapus.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function download(string $id)
    {
        $item = Dokumen::findOrFail($id);

        // Public documents can be downloaded by anyone (handled by routes middleware if needed)
        // Private documents might need auth check, but here we cover admin side so it's auth'd.

        $item->increment('download_count');

        if (Storage::disk('public')->exists($item->file_path)) {
            return Storage::disk('public')->download($item->file_path, $item->file_name);
        }

        return back()->with('error', 'File tidak ditemukan.');
    }
}
