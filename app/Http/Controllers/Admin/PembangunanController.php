<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembangunan;
use Illuminate\Http\Request;

class PembangunanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $pembangunans = Pembangunan::when($search, function($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        })->latest()->paginate(10);
        return view('admin.pembangunan.index', compact('pembangunans', 'search'));
    }

    public function create()
    {
        return view('admin.pembangunan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'kategori' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'anggaran' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'pj' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
            'progress' => 'required|integer|min:0|max:100',
            'sumber_dana' => 'nullable|string|max:255',
            'lat_long' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto_sebelum' => 'nullable|image|max:2048',
            'foto_sesudah' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_sebelum')) {
            $data['foto_sebelum'] = 'storage/' . $request->file('foto_sebelum')->store('pembangunan', 'public');
        }
        if ($request->hasFile('foto_sesudah')) {
            $data['foto_sesudah'] = 'storage/' . $request->file('foto_sesudah')->store('pembangunan', 'public');
        }

        Pembangunan::create($data);
        return redirect()->route('pembangunan.index')->with('success', 'Laporan Pembangunan berhasil ditambahkan');
    }

    public function edit(Pembangunan $pembangunan)
    {
        return view('admin.pembangunan.edit', compact('pembangunan'));
    }

    public function update(Request $request, Pembangunan $pembangunan)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'kategori' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'anggaran' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'pj' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
            'progress' => 'required|integer|min:0|max:100',
            'sumber_dana' => 'nullable|string|max:255',
            'lat_long' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto_sebelum' => 'nullable|image|max:2048',
            'foto_sesudah' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_sebelum')) {
            $data['foto_sebelum'] = 'storage/' . $request->file('foto_sebelum')->store('pembangunan', 'public');
        }
        if ($request->hasFile('foto_sesudah')) {
            $data['foto_sesudah'] = 'storage/' . $request->file('foto_sesudah')->store('pembangunan', 'public');
        }

        $pembangunan->update($data);
        return redirect()->route('pembangunan.index')->with('success', 'Laporan Pembangunan berhasil diperbarui');
    }

    public function destroy(Pembangunan $pembangunan)
    {
        $pembangunan->delete();
        return redirect()->route('pembangunan.index')->with('success', 'Laporan Pembangunan berhasil dihapus');
    }
}
