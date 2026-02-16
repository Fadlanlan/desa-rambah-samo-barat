@extends('layouts.public')

@section('title', 'Transparansi APBDes - Desa Rambah Samo Barat')

@section('content')
<div class="bg-brand-blue-900 pt-32 pb-20 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4">Transparansi Anggaran</h1>
        <p class="text-brand-blue-100 max-w-2xl mx-auto text-lg">Informasi Anggaran Pendapatan dan Belanja Desa (APBDes) Rambah Samo Barat.</p>
    </div>
</div>

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($apbdes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($apbdes as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="p-6 border-b border-slate-50">
                        <div class="flex items-center justify-between mb-2">
                             <h2 class="text-xl font-bold text-slate-900">{{ $item->title }}</h2>
                             <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">{{ $item->tahun ?? date('Y') }}</span>
                        </div>
                        @if($item->deskripsi)
                        <p class="text-slate-500 text-sm">{{ $item->deskripsi }}</p>
                        @endif
                    </div>
                    <div class="bg-slate-100 aspect-auto relative group cursor-zoom-in">
                        @if($item->file_path)
                            <img src="{{ asset('storage/' . $item->file_path) }}" 
                                 alt="{{ $item->title }}" 
                                 class="w-full h-auto object-contain"
                                 onclick="window.open(this.src, '_blank')">
                            <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                                <span class="text-white font-bold bg-black/50 px-4 py-2 rounded-lg backdrop-blur-sm">
                                    <svg class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                    Perbesar Gambar
                                </span>
                            </div>
                        @else
                            <div class="flex h-64 w-full items-center justify-center text-slate-400">
                                <span class="flex flex-col items-center">
                                    <svg class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Tidak ada gambar
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24">
                 <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-6">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-slate-900">Belum ada data APBDes</h3>
                <p class="mt-1 text-slate-500">Informasi APBDes belum tersedia saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection
