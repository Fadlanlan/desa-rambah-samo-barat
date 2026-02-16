@extends('layouts.public')

@section('title', $pengumuman->judul . ' - Pengumuman Desa')

@section('content')
<div class="pt-32 pb-16 bg-white min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('public.pengumuman.index') }}" class="ml-1 text-sm font-medium text-slate-500 hover:text-brand-blue-600 md:ml-2">Pengumuman</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2 line-clamp-1">{{ \Illuminate\Support\Str::limit($pengumuman->judul, 20) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <article class="prose lg:prose-xl prose-slate max-w-none">
            <header class="mb-8 not-prose">
                <div class="flex items-center gap-3 mb-4">
                     @if($pengumuman->prioritas == 'tinggi')
                        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Penting</span>
                    @elseif($pengumuman->prioritas == 'sedang')
                        <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Info</span>
                    @endif
                    <span class="text-slate-500 text-sm">{{ $pengumuman->created_at->format('d F Y') }}</span>
                </div>
                <h1 class="text-3xl lg:text-5xl font-extrabold text-slate-900 leading-tight mb-6">{{ $pengumuman->judul }}</h1>
                
                @if($pengumuman->tanggal_mulai || $pengumuman->tanggal_selesai)
                <div class="bg-slate-50 rounded-lg p-4 border border-slate-100 inline-block">
                    <p class="text-sm text-slate-700 font-medium m-0">
                        <span class="block text-xs text-slate-500 uppercase tracking-wider mb-1">Masa Berlaku</span>
                        {{ $pengumuman->tanggal_mulai ? $pengumuman->tanggal_mulai->format('d M Y') : 'Sekarang' }} 
                        s/d 
                        {{ $pengumuman->tanggal_selesai ? $pengumuman->tanggal_selesai->format('d M Y') : 'Seterusnya' }}
                    </p>
                </div>
                @endif
            </header>

            <div class="mt-8 text-slate-600 leading-relaxed">
                {!! $pengumuman->konten !!}
            </div>
        </article>
        
        <div class="mt-12 pt-8 border-t border-slate-200">
            <a href="{{ route('public.pengumuman.index') }}" class="inline-flex items-center text-sm font-bold text-brand-blue-600 hover:text-brand-blue-700">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Pengumuman
            </a>
        </div>
    </div>
</div>
@endsection
