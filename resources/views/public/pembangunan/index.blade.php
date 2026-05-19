@extends('layouts.public')

@section('title', 'Laporan Pembangunan & Infrastruktur - Desa Rambah Samo Barat')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-brand-blue-900 via-brand-blue-850 to-brand-blue-950 pt-32 pb-24 text-white">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(var(--color-brand-green-500),0.15),transparent_45%)]"></div>
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-6 text-sm text-brand-blue-200" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-brand-blue-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 md:ml-2 text-brand-blue-300">Transparansi</span>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-brand-blue-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 md:ml-2">Laporan Pembangunan</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8 text-left" data-aos="fade-right">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-brand-green-500/20 text-brand-green-300 border border-brand-green-500/30 mb-4 uppercase tracking-widest">
                    🏗️ Laporan Fisik Lapangan
                </span>
                <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                    Log Pembangunan Fisik<br class="hidden sm:inline"> & Infrastruktur Desa
                </h1>
                <p class="text-brand-blue-100 max-w-2xl text-lg leading-relaxed">
                    Galeri pantauan pembangunan desa lengkap dengan foto dokumentasi Sebelum-Sesudah (Before-After), lokasi koordinat, anggaran, dan detail tim kerja pelaksana.
                </p>
            </div>
            
            <div class="lg:col-span-4 flex lg:justify-end" data-aos="fade-left">
                <!-- Year selector -->
                <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/20 shadow-xl w-full max-w-sm">
                    <h3 class="text-sm font-bold text-brand-blue-200 uppercase tracking-wider mb-3">Tahun Anggaran</h3>
                    <form action="" method="GET" class="flex gap-2">
                        <input type="hidden" name="kategori" value="{{ $kategori }}">
                        <select name="year" class="flex-grow rounded-xl bg-slate-900/40 border border-white/25 text-white focus:ring-brand-green-500 focus:border-brand-green-500 py-3 px-4 font-semibold text-lg transition-all">
                            @foreach($years as $yr)
                                <option value="{{ $yr }}" class="bg-slate-900 text-white" {{ $selectedYear == $yr ? 'selected' : '' }}>
                                    TA {{ $yr }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-brand-green-500 hover:bg-brand-green-600 text-white font-bold px-5 rounded-xl transition-all shadow-md active:scale-95 flex items-center justify-center">
                            Filter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Section -->
<div class="py-16 bg-slate-50 min-h-screen" x-data="{ activeProject: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter Pills -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-12 -mt-20 relative z-20" data-aos="fade-up">
            @foreach($kategoris as $kat)
                <a href="?year={{ $selectedYear }}&kategori={{ $kat }}" 
                   class="px-5 py-3 rounded-full text-xs font-bold transition-all shadow-lg active:scale-95 border
                    {{ $kategori === $kat 
                        ? 'bg-brand-blue-600 text-white border-brand-blue-600' 
                        : 'bg-white text-slate-600 hover:text-slate-900 hover:bg-slate-100 border-slate-100' }}">
                    {{ $kat }}
                </a>
            @endforeach
        </div>

        <!-- Projects Grid Showcase -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($pembangunans as $proj)
            <div class="bg-white rounded-3xl overflow-hidden shadow-md border border-slate-100 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between" 
                 data-aos="zoom-in" data-aos-delay="100">
                <div>
                    <!-- Before-After Overlay Visuals -->
                    <div class="relative aspect-video w-full overflow-hidden bg-slate-200 group">
                        <!-- Before Visual -->
                        <div class="absolute inset-0 w-1/2 h-full z-10 border-r-2 border-white/50 overflow-hidden">
                            <img src="{{ $proj->foto_sebelum }}" alt="Sebelum" class="absolute top-0 left-0 w-[200%] h-full object-cover max-w-none">
                            <span class="absolute bottom-2 left-2 z-20 bg-rose-600/90 text-white text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md backdrop-blur-sm shadow border border-rose-500/25">
                                Sebelum
                            </span>
                        </div>
                        <!-- After Visual -->
                        <div class="absolute inset-0 w-full h-full">
                            <img src="{{ $proj->foto_sesudah }}" alt="Sesudah" class="w-full h-full object-cover">
                            <span class="absolute bottom-2 right-2 z-20 bg-emerald-600/90 text-white text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md backdrop-blur-sm shadow border border-emerald-500/25">
                                Sesudah
                            </span>
                        </div>
                        
                        <!-- Hover detail cover overlay -->
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-25 cursor-zoom-in"
                             @click="activeProject = {{ json_encode($proj) }}">
                            <span class="bg-white/95 text-slate-900 font-extrabold text-xs px-4 py-2.5 rounded-xl flex items-center gap-1.5 shadow-xl transition-all hover:scale-105 active:scale-95">
                                <svg class="w-4 h-4 text-brand-blue-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                                Detail Proyek Fisik
                            </span>
                        </div>
                    </div>

                    <!-- Details Body -->
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2 py-0.5 rounded bg-brand-blue-50 text-[10px] text-brand-blue-700 font-black uppercase">
                                {{ $proj->kategori }}
                            </span>
                            <span class="text-[11px] font-semibold text-slate-400">
                                {{ $proj->sumber_dana }}
                            </span>
                        </div>
                        
                        <h3 class="text-base font-bold text-slate-900 leading-snug mb-2 hover:text-brand-blue-600 cursor-pointer"
                            @click="activeProject = {{ json_encode($proj) }}">
                            {{ $proj->nama }}
                        </h3>
                        
                        <p class="text-xs font-semibold text-slate-500 flex items-center gap-1 mb-4">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $proj->lokasi }}
                        </p>

                        <!-- Progress Bar -->
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mb-1.5">
                            <div class="h-1.5 rounded-full transition-all duration-1000
                                @if($proj->progress >= 100)
                                    bg-emerald-500
                                @elseif($proj->progress >= 50)
                                    bg-brand-blue-500
                                @else
                                    bg-amber-500
                                @endif" style="width: {{ $proj->progress }}%"></div>
                        </div>
                        <div class="flex items-center justify-between text-[11px] font-bold text-slate-600">
                            <span class="flex items-center gap-1">
                                @if($proj->status === 'Selesai')
                                    <span class="text-emerald-600 font-bold">✓ {{ $proj->status }}</span>
                                @elseif($proj->status === 'Berjalan')
                                    <span class="text-amber-600 font-bold">➜ {{ $proj->status }}</span>
                                @else
                                    <span class="text-slate-400 font-semibold">⚙ {{ $proj->status }}</span>
                                @endif
                            </span>
                            <span>Progres: {{ $proj->progress }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Footer Card Action -->
                <div class="p-6 pt-0 border-t border-slate-50 flex items-center justify-between mt-4">
                    <span class="text-xs font-black text-slate-800">
                        Rp {{ number_format($proj->anggaran, 0, ',', '.') }}
                    </span>
                    <button class="text-xs font-bold text-brand-blue-600 hover:text-brand-blue-700 flex items-center gap-0.5 transition-colors"
                            @click="activeProject = {{ json_encode($proj) }}">
                        Detail Kegiatan
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-3 py-16 text-center text-slate-400 font-medium">
                Tidak ada laporan pembangunan fisik yang ditemukan untuk kategori atau tahun anggaran ini.
            </div>
            @endforelse
        </div>

        <!-- Dynamic Detail Modal (Murni Alpine.js) -->
        <div x-show="activeProject" 
             class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-all"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="activeProject = null"
             style="display: none;">
            <div class="bg-white rounded-3xl shadow-2xl max-w-3xl w-full overflow-hidden border border-slate-100"
                 @click.away="activeProject = null"
                 data-aos="zoom-in" data-aos-duration="250">
                
                <!-- Modal Header -->
                <div class="p-6 border-b border-slate-100 flex items-start justify-between gap-4">
                    <div>
                        <span class="px-2.5 py-0.5 rounded bg-brand-blue-50 text-[10px] text-brand-blue-700 font-black uppercase inline-block mb-1.5" x-text="activeProject?.kategori"></span>
                        <h3 class="text-lg font-black text-slate-900 leading-snug" x-text="activeProject?.nama"></h3>
                    </div>
                    <button class="w-8 h-8 bg-slate-100 hover:bg-slate-200 rounded-full text-slate-500 hover:text-slate-800 flex items-center justify-center font-bold text-lg transition-all"
                            @click="activeProject = null">
                        &times;
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 max-h-[70vh] overflow-y-auto space-y-6">
                    <!-- Images side-by-side -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="rounded-2xl overflow-hidden border border-slate-100 shadow-inner relative aspect-video bg-slate-50">
                            <img :src="activeProject?.foto_sebelum" class="w-full h-full object-cover">
                            <span class="absolute bottom-2 left-2 z-10 bg-rose-600 text-white text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded shadow">Sebelum Pengerjaan</span>
                        </div>
                        <div class="rounded-2xl overflow-hidden border border-slate-100 shadow-inner relative aspect-video bg-slate-50">
                            <img :src="activeProject?.foto_sesudah" class="w-full h-full object-cover">
                            <span class="absolute bottom-2 left-2 z-10 bg-emerald-600 text-white text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded shadow">Sesudah Pengerjaan</span>
                        </div>
                    </div>

                    <!-- Information Cards Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <span class="block text-slate-400 font-bold uppercase tracking-wider mb-1">Tahun Anggaran</span>
                            <span class="font-extrabold text-slate-800 text-sm" x-text="activeProject?.tahun"></span>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <span class="block text-slate-400 font-bold uppercase tracking-wider mb-1">Nilai Anggaran</span>
                            <span class="font-extrabold text-slate-850 text-sm">Rp <span x-text="new Intl.NumberFormat('id-ID').format(activeProject?.anggaran || 0)"></span></span>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <span class="block text-slate-400 font-bold uppercase tracking-wider mb-1">Realisasi</span>
                            <span class="font-extrabold text-emerald-600 text-sm">Rp <span x-text="new Intl.NumberFormat('id-ID').format(activeProject?.realisasi || 0)"></span></span>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <span class="block text-slate-400 font-bold uppercase tracking-wider mb-1">Sumber Dana</span>
                            <span class="font-extrabold text-slate-800 text-sm" x-text="activeProject?.sumber_dana"></span>
                        </div>
                    </div>

                    <!-- Detailed Description -->
                    <div class="space-y-2">
                        <h4 class="text-sm font-extrabold text-slate-900">Rencana Pengerjaan & Deskripsi Proyek</h4>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium" x-text="activeProject?.deskripsi"></p>
                    </div>

                    <!-- Map Location Coordinators -->
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs">
                        <div class="flex items-center gap-3">
                            <div class="p-2.5 bg-rose-50 text-rose-600 rounded-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-slate-400 font-bold uppercase mb-0.5">Lokasi Koordinat Lapangan</span>
                                <span class="font-extrabold text-slate-800" x-text="activeProject?.lat_long"></span>
                            </div>
                        </div>
                        
                        <a :href="'https://www.google.com/maps/search/?api=1&query=' + activeProject?.lat_long" 
                           target="_blank" 
                           class="bg-rose-600 hover:bg-rose-700 text-white font-bold px-4 py-2 rounded-xl transition-all shadow-sm flex items-center justify-center gap-1">
                            Buka di Google Maps
                        </a>
                    </div>

                    <!-- Person-In-Charge Log -->
                    <div class="flex items-center gap-3 text-xs bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <div class="p-2.5 bg-brand-blue-50 text-brand-blue-600 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <span class="block text-slate-400 font-bold uppercase mb-0.5">Penanggung Jawab Proyek (PJ)</span>
                            <span class="font-extrabold text-slate-800" x-text="activeProject?.pj"></span>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="p-6 border-t border-slate-100 bg-slate-50 flex items-center justify-between text-xs">
                    <span class="text-slate-400 font-semibold">Desa Rambah Samo Barat Mandiri & Akuntabel</span>
                    <button class="bg-slate-900 hover:bg-slate-850 text-white font-bold px-4 py-2 rounded-xl transition-all shadow-sm"
                            @click="activeProject = null">
                        Tutup Laporan
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
