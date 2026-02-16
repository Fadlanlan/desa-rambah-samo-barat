@extends('layouts.public')

@section('title', $agenda->judul . ' - Agenda Desa')

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
                        <a href="{{ route('public.agenda.index') }}" class="ml-1 text-sm font-medium text-slate-500 hover:text-brand-blue-600 md:ml-2">Agenda</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2 line-clamp-1">{{ \Illuminate\Support\Str::limit($agenda->judul, 20) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <article class="prose lg:prose-xl prose-slate max-w-none">
            <header class="mb-8 not-prose">
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-flex items-center rounded-md bg-brand-blue-50 px-2.5 py-1 text-xs font-bold text-brand-blue-700 ring-1 ring-inset ring-brand-blue-600/20">
                        {{ $agenda->kategori ?? 'Kegiatan' }}
                    </span>
                    <span class="text-slate-500 text-sm">{{ $agenda->created_at->format('d F Y') }}</span>
                </div>
                <h1 class="text-3xl lg:text-5xl font-extrabold text-slate-900 leading-tight mb-8">{{ $agenda->judul }}</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-slate-50 rounded-xl p-6 border border-slate-100">
                    <div class="flex items-start gap-4">
                        <div class="rounded-full bg-blue-100 p-2 text-brand-blue-600 shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Waktu</h3>
                            <p class="text-slate-600">
                                {{ $agenda->tanggal_mulai->format('d F Y') }}<br>
                                {{ $agenda->tanggal_mulai->format('H:i') }} WIB - Selesai
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                         <div class="rounded-full bg-red-100 p-2 text-red-600 shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Lokasi</h3>
                            <p class="text-slate-600">{{ $agenda->lokasi ?? 'Kantor Desa' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                         <div class="rounded-full bg-green-100 p-2 text-green-600 shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                             <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Penyelenggara</h3>
                            <p class="text-slate-600">{{ $agenda->penyelenggara ?? 'Pemerintah Desa' }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="mt-8 text-slate-600 leading-relaxed">
                {!! $agenda->deskripsi !!}
            </div>
        </article>
        
        <div class="mt-12 pt-8 border-t border-slate-200">
            <a href="{{ route('public.agenda.index') }}" class="inline-flex items-center text-sm font-bold text-brand-blue-600 hover:text-brand-blue-700">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Agenda
            </a>
        </div>
    </div>
</div>
@endsection
