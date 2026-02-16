@extends('layouts.public')

@section('title', $wisata->nama . ' - Wisata Desa')

@section('content')
<!-- Hero / Header -->
<div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-slate-900 overflow-hidden">
    @if($wisata->gambar)
    <img src="{{ asset('storage/' . $wisata->gambar) }}" class="absolute inset-0 w-full h-full object-cover opacity-40" alt="{{ $wisata->nama }}">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col items-center text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-blue-500/20 border border-brand-blue-400/20 text-brand-blue-300 font-bold text-[10px] uppercase tracking-widest mb-6">
                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                </svg>
                Wisata Desa
            </div>
            <h1 class="text-4xl lg:text-6xl font-extrabold tracking-tight text-white mb-6 uppercase">{{ $wisata->nama }}</h1>
            <div class="flex flex-wrap justify-center gap-6 text-sm text-slate-300 font-medium">
                <div class="flex items-center gap-2">
                    <svg class="h-5 w-5 text-brand-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                    {{ $wisata->lokasi ?: 'Desa Rambah Samo Barat' }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Content -->
            <div class="lg:col-span-2 space-y-12">
                <section>
                    <h2 class="text-2xl font-black text-slate-900 mb-6 tracking-tight flex items-center gap-3">
                        <span class="w-8 h-1.5 bg-brand-blue-600 rounded-full"></span>
                        Tentang Wisata
                    </h2>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-lg">
                        {!! nl2br(e($wisata->deskripsi)) !!}
                    </div>
                </section>
                
                @if($wisata->gambar)
                <section>
                    <div class="rounded-[2rem] overflow-hidden shadow-2xl">
                        <img src="{{ asset('storage/' . $wisata->gambar) }}" class="w-full h-auto" alt="{{ $wisata->nama }}">
                    </div>
                </section>
                @endif
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-8">
                <div class="bg-slate-50 rounded-[2rem] p-8 border border-slate-100 sticky top-32">
                    <h3 class="text-xl font-bold text-slate-900 mb-8 tracking-tight">Informasi Kunjungan</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-brand-blue-600 shadow-sm flex-shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Harga Tiket</p>
                                <p class="text-slate-900 font-bold">{{ $wisata->harga_tiket ?: 'Gratis / Sukarela' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-brand-green-600 shadow-sm flex-shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Jam Operasional</p>
                                <p class="text-slate-900 font-bold">{{ $wisata->jam_operasional ?: '08:00 - 17:00' }}</p>
                            </div>
                        </div>

                        @if($wisata->kontak)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-amber-600 shadow-sm flex-shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Kontak Informasi</p>
                                <p class="text-slate-900 font-bold">{{ $wisata->kontak }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="mt-12">
                        <a href="{{ route('public.wisata.index') }}" class="flex items-center justify-center gap-2 px-6 py-4 bg-slate-900 text-white rounded-2xl text-sm font-bold hover:bg-slate-800 transition-all uppercase tracking-widest">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
