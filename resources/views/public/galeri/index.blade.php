@extends('layouts.public')

@section('title', 'Galeri Desa - Desa Rambah Samo Barat')

@section('content')
<div class="bg-brand-blue-900 pt-32 pb-20 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4">Galeri Desa</h1>
        <p class="text-brand-blue-100 max-w-2xl mx-auto text-lg">Dokumentasi kegiatan, potensi, and momen-momen penting di Desa Rambah Samo Barat.</p>
    </div>
</div>

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($galleries->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($galleries as $gallery)
                <div class="group relative aspect-square overflow-hidden rounded-xl bg-white shadow-sm hover:shadow-xl transition-all duration-300">
                    @if($gallery->file_path)
                    <img src="{{ asset('storage/' . $gallery->file_path) }}" 
                         alt="{{ $gallery->judul }}" 
                         class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                    @else
                    <div class="flex h-full w-full items-center justify-center bg-slate-200 text-slate-400">
                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end p-6">
                        <div>
                            <p class="text-white font-bold text-lg leading-tight transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">{{ $gallery->judul }}</p>
                            @if($gallery->kategori)
                            <p class="text-white/80 text-xs uppercase tracking-wider mt-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">{{ $gallery->kategori }}</p>
                            @endif
                            @if($gallery->deskripsi)
                            <p class="text-white/70 text-sm mt-2 line-clamp-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-100">{{ $gallery->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $galleries->links() }}
            </div>
        @else
            <div class="text-center py-24">
                <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-6">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-slate-900">Belum ada foto</h3>
                <p class="mt-1 text-slate-500">Galeri foto desa belum tersedia saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection
