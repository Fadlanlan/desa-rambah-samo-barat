@extends('layouts.public')

@section('title', $berita->judul . ' - Desa Rambah Samo Barat')

@section('content')
<div class="bg-white min-h-screen pb-20">
    <!-- Article Header -->
    <div class="pt-32 pb-16 bg-slate-50 border-b border-slate-100">
        <div class="container mx-auto px-6 max-w-4xl">
            <nav class="flex mb-8 text-[10px] font-bold uppercase tracking-widest text-slate-400 gap-2 items-center">
                <a href="/" class="hover:text-brand-blue-600 transition-colors">Beranda</a>
                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <a href="{{ route('public.berita.index') }}" class="hover:text-brand-blue-600 transition-colors">Berita</a>
                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-slate-900">{{ $berita->category?->name }}</span>
            </nav>

            <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-8 tracking-tight">
                {{ $berita->judul }}
            </h1>

            <div class="flex flex-wrap items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-brand-blue-600 flex items-center justify-center text-white font-bold text-sm">
                        {{ substr($berita->penulis?->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-900 leading-none mb-1">{{ $berita->penulis?->name ?? 'Admin Desa' }}</p>
                        <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Penulis</p>
                    </div>
                </div>

                <div class="h-8 w-px bg-slate-200 hidden md:block"></div>

                <div>
                    <p class="text-xs font-bold text-slate-900 leading-none mb-1">{{ $berita->published_at?->format('d M Y') }}</p>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Terbit</p>
                </div>

                <div class="h-8 w-px bg-slate-200 hidden md:block"></div>

                <div>
                    <p class="text-xs font-bold text-slate-900 leading-none mb-1">{{ $berita->views_count }}</p>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Dilihat</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="container mx-auto px-6 max-w-4xl -mt-10 relative z-10">
        @if($berita->gambar)
        <div class="mb-12">
            <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-full h-auto aspect-video object-cover rounded-[2rem] shadow-2xl shadow-slate-200 border-8 border-white" alt="{{ $berita->judul }}">
        </div>
        @endif

        <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed font-serif">
            {!! nl2br($berita->konten) !!}
        </div>

        <!-- Share & Tags -->
        <div class="mt-16 pt-10 border-t border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Bagikan:</span>
                <div class="flex gap-2">
                    <button class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-brand-blue-50 hover:text-brand-blue-600 transition-all border border-slate-100">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </button>
                    <button class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-brand-blue-50 hover:text-brand-blue-600 transition-all border border-slate-100">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Related News -->
        @if($relatedNews->count() > 0)
        <div class="mt-20">
            <h3 class="text-2xl font-black text-slate-900 mb-8 flex items-center gap-3">
                <span class="w-2 h-8 bg-brand-green-500 rounded-full"></span>
                Berita Terkait
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($relatedNews as $related)
                <a href="{{ route('public.berita.show', $related->slug) }}" class="group">
                    <div class="relative h-40 overflow-hidden rounded-2xl mb-4 border border-slate-100">
                         @if($related->gambar)
                         <img src="{{ asset('storage/' . $related->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="">
                         @else
                         <div class="w-full h-full bg-slate-50 flex items-center justify-center">
                             <svg class="h-8 w-8 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                         </div>
                         @endif
                    </div>
                    <h4 class="text-sm font-bold text-slate-900 leading-snug group-hover:text-brand-blue-600 transition-colors">
                        {{ \Illuminate\Support\Str::limit($related->judul, 50) }}
                    </h4>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
