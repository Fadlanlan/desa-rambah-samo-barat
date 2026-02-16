<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('pengumuman.view'); // Using existing permission or updated one

        $query = Pengumuman::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $items = $query->latest()->paginate(15);

        return view('admin.pengumuman.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('pengumuman.create');
        return view('admin.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('pengumuman.create');

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            // 'is_active' => 'boolean', // Removed from validation to handle manually
        ]);

        // Manually handle checkbox and user_id
        $validated['is_active'] = $request->has('is_active');
        $validated['user_id'] = Auth::id() ?? 1; // Fallback to 1 if auth fails (shouldn't happen with middleware)

        try {
            Pengumuman::create($validated);
            return redirect()->route('pengumuman.index')
                ->with('success', 'Pengumuman berhasil dibuat.');
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
        Gate::authorize('pengumuman.edit');
        $item = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('pengumuman.edit');

        $item = Pengumuman::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            // 'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        try {
            $item->update($validated);
            return redirect()->route('pengumuman.index')
                ->with('success', 'Pengumuman berhasil diperbarui.');
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
        Gate::authorize('pengumuman.delete');

        try {
            $item = Pengumuman::findOrFail($id);
            $item->delete();
            return redirect()->route('pengumuman.index')
                ->with('success', 'Pengumuman berhasil dihapus.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
