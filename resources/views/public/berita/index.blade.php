@extends('layouts.public')

@section('title', 'Berita & Informasi - Desa Rambah Samo Barat')

@section('content')
<div class="bg-slate-50 min-h-screen pb-20">
    <!-- Hero Section -->
    <div class="bg-brand-blue-900 pt-32 pb-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
            </svg>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tight">Pusat Informasi Desa</h1>
            <p class="text-brand-blue-100 text-lg max-w-2xl mx-auto">Update terbaru seputar kegiatan, pembangunan, dan pengumuman resmi Desa Rambah Samo Barat.</p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar: Categories -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Search -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                    <form action="{{ route('public.berita.index') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}"
                               class="w-full pl-10 pr-4 py-3 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-brand-blue-500">
                        <svg class="h-5 w-5 text-slate-400 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </form>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-brand-green-500 rounded-full"></span>
                        Kategori
                    </h3>
                    <div class="space-y-2">
                        <a href="{{ route('public.berita.index') }}" 
                           class="flex items-center justify-between p-3 rounded-2xl transition-all {{ !request('category') ? 'bg-brand-blue-50 text-brand-blue-700 font-bold' : 'hover:bg-slate-50 text-slate-600' }}">
                            <span class="text-sm">Semua Berita</span>
                            <span class="text-[10px] bg-white px-2 py-0.5 rounded-full border border-slate-100">{{ \App\Models\Berita::published()->count() }}</span>
                        </a>
                        @foreach ($categories as $category)
                        <a href="{{ route('public.berita.index', ['category' => $category->slug]) }}" 
                           class="flex items-center justify-between p-3 rounded-2xl transition-all {{ request('category') == $category->slug ? 'bg-brand-blue-50 text-brand-blue-700 font-bold' : 'hover:bg-slate-50 text-slate-600' }}">
                            <span class="text-sm">{{ $category->name }}</span>
                            <span class="text-[10px] bg-white px-2 py-0.5 rounded-full border border-slate-100">{{ $category->berita_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- News Grid -->
            <div class="lg:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @if ($news->count() > 0)
                        @foreach ($news as $article)
                        <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group border border-slate-100">
                            <div class="relative h-48 overflow-hidden">
                                @if ($article->gambar)
                                <img src="{{ asset('storage/' . $article->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $article->judul }}">
                                @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-[10px] font-bold text-slate-800 uppercase tracking-wider shadow-sm">
                                        {{ $article->category?->name ?? 'Berita' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-3">
                                    <span>{{ $article->published_at?->format('d M Y') }}</span>
                                    <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                    <span>{{ $article->views_count }} Views</span>
                                </div>
                                <h2 class="text-lg font-bold text-slate-900 leading-snug mb-3 group-hover:text-brand-blue-600 transition-colors">
                                    <a href="{{ route('public.berita.show', $article->slug) }}">
                                        {{ \Illuminate\Support\Str::limit($article->judul, 60) }}
                                    </a>
                                </h2>
                                <p class="text-sm text-slate-500 leading-relaxed mb-6">
                                    {{ \Illuminate\Support\Str::limit($article->ringkasan ?? strip_tags($article->konten), 100) }}
                                </p>
                                <a href="{{ route('public.berita.show', $article->slug) }}" class="inline-flex items-center text-xs font-black text-brand-blue-600 uppercase tracking-[0.2em] group-hover:gap-2 transition-all">
                                    Selengkapnya
                                    <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </article>
                        @endforeach
                    @else
                        <div class="col-span-1 md:col-span-3 p-20 text-center">
                             <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                 <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                             </div>
                             <h3 class="text-xl font-bold text-slate-900 mb-2">Belum ada berita</h3>
                             <p class="text-slate-500">Coba gunakan kata kunci pencarian lain atau pilih kategori berbeda.</p>
                        </div>
                    @endif
                </div>

                @if($news->hasPages())
                <div class="mt-12">
                    {{ $news->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
