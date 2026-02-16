<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     */
    public function index(Request $request)
    {
        $query = Berita::published()->with(['category', 'penulis']);

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $news = $query->latest('published_at')->paginate(9);
        $categories = Category::withCount(['berita' => function ($q) {
            $q->published();
        }])->get();

        return view('public.berita.index', compact('news', 'categories'));
    }

    /**
     * Display the specified news.
     */
    public function show($slug)
    {
        $berita = Berita::published()
            ->with(['category', 'penulis'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $berita->increment('views_count');

        $relatedNews = Berita::published()
            ->where('category_id', $berita->category_id)
            ->where('id', '!=', $berita->id)
            ->limit(3)
            ->get();

        return view('public.berita.show', compact('berita', 'relatedNews'));
    }
}
