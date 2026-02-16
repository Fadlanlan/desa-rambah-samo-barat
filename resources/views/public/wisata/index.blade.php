@extends('layouts.public')

@section('title', 'Wisata Desa - Desa Rambah Samo Barat')

@section('content')
<div class="bg-brand-blue-900 pt-32 pb-20 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4">Wisata Desa</h1>
        <p class="text-brand-blue-100 max-w-2xl mx-auto text-lg">Jelajahi keindahan dan potensi wisata alam serta budaya di Desa Rambah Samo Barat.</p>
    </div>
</div>

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($wisatas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($wisatas as $wisata)
                <div class="group rounded-[2rem] border border-slate-100 bg-white overflow-hidden shadow-sm transition hover:shadow-2xl hover:-translate-y-2 duration-500 flex flex-col h-full">
                    <div class="aspect-[16/10] w-full overflow-hidden relative">
                        @if($wisata->gambar)
                        <img src="{{ asset('storage/' . $wisata->gambar) }}" alt="{{ $wisata->nama }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                        @else
                        <div class="flex h-full w-full items-center justify-center text-slate-300 bg-slate-100">
                            <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        @endif
                        
                        @if($wisata->harga_tiket)
                        <div class="absolute top-4 right-4">
                             <span class="inline-flex items-center rounded-full bg-white/90 backdrop-blur px-4 py-1.5 text-xs font-bold text-slate-900 shadow-sm">
                                Rp {{ $wisata->harga_tiket }}
                            </span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="h-4 w-4 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">{{ $wisata->lokasi ?: 'Desa Rambah Samo Barat' }}</span>
                        </div>
                        
                        <h3 class="font-bold text-2xl text-slate-900 mb-3 group-hover:text-brand-blue-600 transition-colors leading-tight">
                            <a href="{{ route('public.wisata.show', $wisata->slug) }}">{{ $wisata->nama }}</a>
                        </h3>
                        
                        <p class="text-slate-600 mb-6 line-clamp-3 text-sm leading-relaxed">{{ $wisata->deskripsi }}</p>
                        
                        <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex items-center text-slate-400 text-xs">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $wisata->jam_operasional ?: 'Setiap Hari' }}
                            </div>
                            
                            <a href="{{ route('public.wisata.show', $wisata->slug) }}" class="inline-flex items-center text-xs font-black text-brand-blue-600 uppercase tracking-widest group-hover:gap-2 transition-all">
                                Detail
                                <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $wisatas->links() }}
            </div>
        @else
            <div class="text-center py-24">
                <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-6">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-slate-900">Belum ada Objek Wisata</h3>
                <p class="mt-1 text-slate-500">Informasi wisata desa belum tersedia saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection
