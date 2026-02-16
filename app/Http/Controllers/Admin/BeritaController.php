<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\News\NewsService;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('berita.view');

        $perPage = $request->get('limit', 15);
        $filters = $request->only(['search', 'category_id']);

        // Using a more general list method for admin
        $news = \App\Models\Berita::with(['category', 'penulis'])
            ->latest()
            ->paginate($perPage);

        return view('admin.berita.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('berita.create');
        $categories = Category::all();
        return view('admin.berita.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('berita.create');

        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'konten' => ['required', 'string'],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'is_published' => ['boolean'],
            'is_featured' => ['boolean'],
            'gambar' => ['nullable', 'image', 'max:2048'], // 2MB
        ]);

        $data['user_id'] = Auth::id();

        if ($request->has('is_published') && $data['is_published']) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('news', 'public');
            $data['gambar'] = $path;
        }

        try {
            $this->newsService->createNews($data);
            return redirect()->route('berita.index')
                ->with('success', 'Berita berhasil diterbitkan.');
        }
        catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('berita.edit');
        $berita = \App\Models\Berita::findOrFail($id);
        $categories = Category::all();
        return view('admin.berita.edit', compact('berita', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('berita.edit');

        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'konten' => ['required', 'string'],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'is_published' => ['boolean'],
            'is_featured' => ['boolean'],
            'gambar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->has('is_published') && $data['is_published']) {
            $berita = \App\Models\Berita::find($id);
            if (!$berita->published_at) {
                $data['published_at'] = now();
            }
        }

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('news', 'public');
            $data['gambar'] = $path;
        }

        try {
            $this->newsService->updateNews($id, $data);
            return redirect()->route('berita.index')
                ->with('success', 'Berita berhasil diperbarui.');
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
        $this->authorize('berita.delete');

        try {
            $this->newsService->deleteNews($id);
            return redirect()->route('berita.index')
                ->with('success', 'Berita berhasil dihapus.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
