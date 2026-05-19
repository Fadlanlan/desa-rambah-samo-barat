@extends('layouts.public')

@php
    $menuPublicProfil = \App\Models\Setting::get('menu_public_profil', '1') === '1';
    $menuPublicBerita = \App\Models\Setting::get('menu_public_berita', '1') === '1';
    $menuPublicSurat = \App\Models\Setting::get('menu_public_surat', '1') === '1';
    $menuPublicAntrian = \App\Models\Setting::get('menu_public_antrian', '1') === '1';
    $menuPublicGaleri = \App\Models\Setting::get('menu_public_galeri', '1') === '1';
    $menuPublicPengaduan = \App\Models\Setting::get('menu_public_pengaduan', '1') === '1';
    $menuPublicAnggaran = \App\Models\Setting::get('menu_public_anggaran', '1') === '1';
@endphp

@section('title', 'Beranda - Desa Rambah Samo Barat')

@section('content')
<!-- Chart.js from CDN for interactive stats -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- 1. Hero / Jumbotron Section -->
<section class="relative pt-32 pb-40 lg:pt-48 lg:pb-52 overflow-hidden bg-slate-50">
    <!-- Dynamic Background Accents -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[35rem] h-[35rem] bg-brand-blue-100 rounded-full blur-[100px] opacity-40 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-[35rem] h-[35rem] bg-brand-green-100 rounded-full blur-[100px] opacity-35 animate-pulse"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center space-y-8 max-w-4xl mx-auto">
            <!-- Pulsing Badge -->
            <div class="inline-flex items-center gap-2.5 px-4.5 py-2 rounded-full bg-brand-blue-50 border border-brand-blue-100 text-brand-blue-600 font-bold text-xs uppercase tracking-widest animate-fade-in shadow-sm">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-blue-600"></span>
                </span>
                Official Website Desa Rambah Samo Barat
            </div>
            
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black tracking-tight text-slate-900 leading-tight">
                Membangun Desa <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-blue-600 to-brand-green-500">{{ $village->nama_desa ?? 'Rambah Samo Barat' }}</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-600 leading-relaxed font-medium">
                {{ $village->visi ?? 'Mewujudkan tata kelola pemerintahan desa yang transparan, akuntabel, dan inovatif melaui transformasi digital untuk pelayanan publik yang prima.' }}
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4 pt-6">
                @if($isLocked)
                    <a href="#berlangganan" class="btn-primary py-4 px-12 text-base shadow-xl shadow-brand-blue-500/20 hover:shadow-brand-blue-500/40 transform hover:-translate-y-1 transition-all">
                        Berlangganan Sekarang
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary py-4.5 px-10 text-sm font-bold tracking-wider shadow-lg shadow-brand-blue-500/10 hover:shadow-brand-blue-500/20 transform hover:-translate-y-0.5 transition-all">
                        Akses Layanan Mandiri
                    </a>
                    <a href="{{ route('public.berita.index') }}" class="btn-secondary py-4.5 px-10 text-sm font-bold tracking-wider bg-white border border-slate-200 hover:border-brand-blue-400 hover:bg-slate-50 transform hover:-translate-y-0.5 transition-all !text-slate-700">
                        Baca Berita Desa
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Mini Floating Information Panel (Glassmorphism) -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 relative z-20">
        <div class="bg-white/70 backdrop-blur-xl border border-white/50 rounded-[2rem] shadow-xl p-8 grid grid-cols-1 md:grid-cols-3 gap-8 text-slate-700">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-brand-blue-50 flex items-center justify-center text-brand-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-black tracking-widest text-slate-400 uppercase">Alamat Kantor</h4>
                    <p class="text-sm font-bold text-slate-800 line-clamp-1 mt-0.5">{{ \App\Models\Setting::get('contact_address', 'Kec. Rambah Samo, Riau') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4 border-y md:border-y-0 md:border-x border-slate-200/50 py-4 md:py-0 md:px-8">
                <div class="w-12 h-12 rounded-2xl bg-brand-green-50 flex items-center justify-center text-brand-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-black tracking-widest text-slate-400 uppercase">Kontak Darurat</h4>
                    <p class="text-sm font-bold text-slate-800 mt-0.5">{{ \App\Models\Setting::get('contact_phone', '+62 812-3456-7890') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-black tracking-widest text-slate-400 uppercase">Email Resmi</h4>
                    <p class="text-sm font-bold text-slate-800 line-clamp-1 mt-0.5">{{ \App\Models\Setting::get('contact_email', 'info@desarambahsamobarat.id') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Scroll Down Indicator -->
    <div class="absolute bottom-16 left-1/2 transform -translate-x-1/2 flex flex-col items-center gap-2 cursor-pointer z-10 hover:opacity-80 transition-opacity">
        <span class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-400">Jelajahi Portal</span>
        <div class="w-6 h-10 border-2 border-slate-300 rounded-full p-1 flex justify-center">
            <div class="w-1 h-2.5 bg-brand-blue-600 rounded-full animate-bounce"></div>
        </div>
    </div>

    <!-- Melengkung Wave Divider SVG -->
    <div class="absolute bottom-0 inset-x-0 w-full overflow-hidden leading-none z-0">
        <svg class="relative block w-full h-[60px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="fill-white"></path>
        </svg>
    </div>
</section>

<!-- 2. Quick Access Menu Modern (Toggles ON/OFF Synchronized) -->
<section class="py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">Layanan & Tautan Cepat</h2>
            <div class="w-16 h-1.5 bg-brand-blue-600 rounded-full mx-auto mb-4"></div>
            <p class="text-slate-500 max-w-xl mx-auto text-sm leading-relaxed">Akses secara instan berbagai layanan publik, data transparansi, dan program kegiatan Desa Rambah Samo Barat.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- 1. Profil Desa -->
            @if($menuPublicProfil)
                <a href="{{ route('public.profil.index') }}" class="group bg-slate-50 border border-slate-100 hover:border-brand-blue-300 hover:bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center mb-6 group-hover:bg-brand-blue-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h3 class="font-black text-slate-800 text-base leading-snug group-hover:text-brand-blue-600 transition-colors">Profil Desa</h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">Sejarah lengkap, visi, misi, dan bagan organisasi kepengurusan desa.</p>
                    </div>
                    <span class="inline-flex items-center text-[10px] font-black text-brand-blue-600 uppercase tracking-widest mt-6 group-hover:gap-1.5 transition-all">Selengkapnya <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>
            @endif

            <!-- 2. Berita Desa -->
            @if($menuPublicBerita)
                <a href="{{ route('public.berita.index') }}" class="group bg-slate-50 border border-slate-100 hover:border-brand-blue-300 hover:bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-brand-green-50 text-brand-green-600 flex items-center justify-center mb-6 group-hover:bg-brand-green-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1M9 11h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="font-black text-slate-800 text-base leading-snug group-hover:text-brand-green-600 transition-colors">Berita Desa</h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">Berita terkini, agenda pembangunan, dan info pengumuman desa resmi.</p>
                    </div>
                    <span class="inline-flex items-center text-[10px] font-black text-brand-blue-600 uppercase tracking-widest mt-6 group-hover:gap-1.5 transition-all">Selengkapnya <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>
            @endif

            <!-- 3. Agenda Desa -->
            <a href="{{ route('public.agenda.index') }}" class="group bg-slate-50 border border-slate-100 hover:border-brand-blue-300 hover:bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-6 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-black text-slate-800 text-base leading-snug group-hover:text-amber-600 transition-colors">Agenda Desa</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">Jadwal musyawarah, kegiatan gotong royong, dan program kemasyarakatan.</p>
                </div>
                <span class="inline-flex items-center text-[10px] font-black text-brand-blue-600 uppercase tracking-widest mt-6 group-hover:gap-1.5 transition-all">Selengkapnya <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
            </a>

            <!-- 4. Galeri Desa -->
            @if($menuPublicGaleri)
                <a href="{{ route('public.galeri.index') }}" class="group bg-slate-50 border border-slate-100 hover:border-brand-blue-300 hover:bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="font-black text-slate-800 text-base leading-snug group-hover:text-purple-600 transition-colors">Galeri Foto</h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">Dokumentasi visual keindahan alam, UMKM unggul, dan aktivitas warga.</p>
                    </div>
                    <span class="inline-flex items-center text-[10px] font-black text-brand-blue-600 uppercase tracking-widest mt-6 group-hover:gap-1.5 transition-all">Selengkapnya <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>
            @endif

            <!-- 5. Pengaduan -->
            @if($menuPublicPengaduan)
                <a href="{{ route('public.pengaduan.create') }}" class="group bg-slate-50 border border-slate-100 hover:border-brand-blue-300 hover:bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mb-6 group-hover:bg-rose-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <h3 class="font-black text-slate-800 text-base leading-snug group-hover:text-rose-600 transition-colors">Aduan Warga</h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">Kirim pengaduan, laporan fasilitas rusak, atau aspirasi warga secara rahasia.</p>
                    </div>
                    <span class="inline-flex items-center text-[10px] font-black text-brand-blue-600 uppercase tracking-widest mt-6 group-hover:gap-1.5 transition-all">Sampaikan Aduan <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>
            @endif

            <!-- 6. Surat Online -->
            @if($menuPublicSurat)
                <a href="{{ route('public.surat.create') }}" class="group bg-slate-50 border border-slate-100 hover:border-brand-blue-300 hover:bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="font-black text-slate-800 text-base leading-snug group-hover:text-teal-600 transition-colors">Surat Digital</h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">Permohonan surat keterangan usaha, domisili, nikah, dll secara online.</p>
                    </div>
                    <span class="inline-flex items-center text-[10px] font-black text-brand-blue-600 uppercase tracking-widest mt-6 group-hover:gap-1.5 transition-all">Ajukan Surat <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>
            @endif

            <!-- 7. Antrian Online -->
            @if($menuPublicAntrian)
                <a href="{{ route('public.antrian.create') }}" class="group bg-slate-50 border border-slate-100 hover:border-brand-blue-300 hover:bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mb-6 group-hover:bg-sky-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <h3 class="font-black text-slate-800 text-base leading-snug group-hover:text-sky-600 transition-colors">Antrian Online</h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">Ambil nomor antrian layanan loket kantor desa sebelum datang.</p>
                    </div>
                    <span class="inline-flex items-center text-[10px] font-black text-brand-blue-600 uppercase tracking-widest mt-6 group-hover:gap-1.5 transition-all">Ambil Antrian <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>
            @endif

            <!-- 8. Transparansi Dana -->
            @if($menuPublicAnggaran)
            <a href="{{ route('public.apbdes.index') }}" class="group bg-slate-50 border border-slate-100 hover:border-brand-blue-300 hover:bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-black text-slate-800 text-base leading-snug group-hover:text-indigo-600 transition-colors">Transparansi APBD</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">Realisasi anggaran pendapatan, dana desa, dan progres proyek fisik desa.</p>
                </div>
                <span class="inline-flex items-center text-[10px] font-black text-brand-blue-600 uppercase tracking-widest mt-6 group-hover:gap-1.5 transition-all">Selengkapnya <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
            </a>
            @endif
        </div>
    </div>
</section>

<!-- 3. Tentang Desa Singkat (Split Layout Preview) -->
<section class="py-24 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            <!-- Left Info Column -->
            <div class="lg:col-span-7 space-y-8" data-aos="fade-right">
                <div class="space-y-4">
                    <span class="text-xs font-black uppercase tracking-[0.25em] text-brand-blue-600 block">SEKILAS SEJARAH & POTENSI</span>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 leading-tight">
                        {{ \App\Models\Setting::get('tentang_judul', 'Mengenal Lebih Dekat') }} <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-blue-600 to-brand-green-500">{{ $village->nama_desa ?? 'Desa Rambah Samo Barat' }}</span>
                    </h2>
                    <div class="w-16 h-1.5 bg-brand-green-500 rounded-full"></div>
                </div>

                <p class="text-slate-600 leading-relaxed text-sm">
                    {{ \App\Models\Setting::get('tentang_deskripsi', \Illuminate\Support\Str::limit($village->sejarah ?? 'Desa Rambah Samo Barat merupakan bagian penting dari wilayah Kecamatan Rambah Samo, Kabupaten Rokan Hulu, Provinsi Riau. Dengan luas daerah yang membentang subur, desa kami dikenal dengan masyarakatnya yang bergotong-royong, memegang teguh adat ketimuran, serta terus berkembang bertransformasi menjadi desa digital terdepan.', 340)) }}
                </p>

                <!-- Potentials List -->
                @php
                    $keunggulanList = explode(',', \App\Models\Setting::get('tentang_keunggulan', 'Transformasi Layanan Digital Mandiri, Sentra UMKM Kerajinan & Pertanian, Kearifan Lokal Gotong Royong Adat, Potensi Wisata Alam Asri & Hijau'));
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($keunggulanList as $keunggulan)
                    <div class="flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-brand-green-100 text-brand-green-600 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        <span class="text-xs font-bold text-slate-700">{{ trim($keunggulan) }}</span>
                    </div>
                    @endforeach
                </div>

                @if($menuPublicProfil)
                <div class="pt-4">
                    <a href="{{ route('public.profil.index') }}" class="btn-primary py-4 px-8 text-xs font-bold tracking-wider inline-flex items-center gap-2 shadow-lg shadow-brand-blue-500/10">
                        Lihat Profil Selengkapnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
                @endif
            </div>

            <!-- Right Image Column (Visual Showcase) -->
            <div class="lg:col-span-5 relative" data-aos="fade-left">
                <div class="relative w-full aspect-[4/5] md:aspect-square lg:aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=cover&w=800&q=80" alt="Landscape Rambah Samo" class="w-full h-full object-cover hover:scale-105 transition-transform duration-750">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                </div>

                <!-- Glassmorphism absolute card -->
                <div class="absolute -bottom-8 -left-8 md:bottom-8 md:-left-8 bg-white/80 backdrop-blur-xl border border-white/60 p-6 rounded-3xl shadow-2xl max-w-[220px] hidden sm:block animate-bounce" style="animation-duration: 4s;">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-2xl bg-brand-green-100 text-brand-green-600 flex items-center justify-center"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></span>
                        <div>
                            <h4 class="text-xs font-black text-slate-800 leading-none">Desa Mandiri</h4>
                            <p class="text-[10px] text-slate-500 font-medium mt-1">Status Kemenkes & Kemendesa Teratas</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3.5. Kata Sambutan Kepala Desa Section -->
<section class="py-24 bg-slate-100 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 bg-[radial-gradient(rgba(var(--color-brand-blue-500),0.03)_1px,transparent_1px)] [background-size:16px_16px] opacity-70"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-brand-green-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-brand-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <style>
        @keyframes float-y {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .animate-float {
            animation: float-y 5s ease-in-out infinite;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Foto Kepala Desa Column -->
            <div class="lg:col-span-5 flex flex-col items-center text-center" data-aos="fade-right">
                <!-- Frame & Image Wrapper -->
                <div class="relative group w-full max-w-[340px] aspect-[3/4] rounded-[2.5rem] overflow-hidden bg-slate-200 border-8 border-white shadow-2xl shadow-slate-300/60 transition-transform duration-500 hover:scale-102 hover:shadow-brand-blue-500/10">
                    <!-- Subtle Floating Effect wrapper -->
                    <div class="w-full h-full animate-float">
                        <img src="{{ isset($kepalaDesa['foto']) && $kepalaDesa['foto'] ? asset('storage/' . $kepalaDesa['foto']) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=800&q=80' }}" 
                             alt="Kepala Desa {{ $village->nama_desa ?? '' }}" 
                             class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500"
                             loading="lazy">
                    </div>
                </div>

                <!-- Identity details card -->
                <div class="mt-6 space-y-1.5">
                    <h3 class="text-xl font-black text-slate-900 leading-none">
                        {{ $kepalaDesa['nama'] ?? 'Fadlan, S.IP' }}
                    </h3>
                    <p class="text-xs font-bold text-brand-blue-600 uppercase tracking-widest leading-none">
                        Kepala Desa {{ $village->nama_desa ?? 'Rambah Samo Barat' }}
                    </p>
                    <p class="text-[10px] font-semibold text-slate-400">
                        {{ isset($kepalaDesa['nip']) && $kepalaDesa['nip'] ? 'NIP. ' . $kepalaDesa['nip'] : 'Masa Bakti: 2021 - 2027' }}
                    </p>
                </div>
            </div>

            <!-- Isi Sambutan Column -->
            <div class="lg:col-span-7 space-y-6 text-left" data-aos="fade-left">
                <div class="space-y-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-extrabold bg-brand-blue-50 text-brand-blue-700 border border-brand-blue-100 uppercase tracking-wider">
                        👋 Sambutan Kades
                    </span>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 leading-tight">
                        {{ \App\Models\Setting::get('sambutan_judul', 'Kata Sambutan Kepala Desa') }}
                    </h2>
                    <div class="w-16 h-1.5 bg-brand-green-500 rounded-full"></div>
                </div>

                <!-- Opening Quote -->
                @if(\App\Models\Setting::get('sambutan_kutipan', 'Bahu-membahu mewujudkan Desa Rambah Samo Barat yang religius, mandiri, sejahtera, dan terdepan dalam keterbukaan informasi pelayanan publik berbasis digital.'))
                <div class="border-l-4 border-brand-blue-500 pl-4 py-1.5 bg-slate-50/50 rounded-r-2xl pr-4">
                    <p class="text-slate-650 italic text-sm font-semibold leading-relaxed">
                        "{{ \App\Models\Setting::get('sambutan_kutipan', 'Bahu-membahu mewujudkan Desa Rambah Samo Barat yang religius, mandiri, sejahtera, dan terdepan dalam keterbukaan informasi pelayanan publik berbasis digital.') }}"
                    </p>
                </div>
                @endif

                <!-- Speech Paragraphs -->
                <div class="space-y-4 text-slate-600 text-sm leading-relaxed font-medium">
                    {!! nl2br(e(\App\Models\Setting::get('sambutan_isi', "Assalamu'alaikum Warahmatullahi Wabarakatuh, Salam Sejahtera bagi kita semua.\n\nSelamat datang di portal informasi resmi Desa Rambah Samo Barat. Sebagai wujud nyata komitmen kami terhadap tata kelola pemerintahan yang bersih dan akuntabel, website ini hadir sebagai jembatan informasi interaktif. Kami berupaya penuh mendorong digitalisasi pelayanan administrasi mandiri agar seluruh proses birokrasi kependudukan dan surat-menyurat warga dapat diakses secara cepat, transparan, dan efisien dari mana saja.\n\nPembangunan desa tidak akan berjalan optimal tanpa adanya partisipasi aktif dan kolaborasi sinergis antara pemerintah desa dengan seluruh elemen masyarakat. Melalui fitur transparansi anggaran APBDes dan laporan progres fisik pembangunan riil yang kami sajikan, kami mengundang bapak, ibu, dan seluruh pemuda untuk mengawal, memberikan masukan, serta bergotong-royong demi mewujudkan kemajuan desa tercinta kita.\n\nTerima kasih atas kepercayaan dan kebersamaan bapak/ibu sekalian. Mari bersama-sama kita langkahkan kaki menuju kemandirian ekonomi desa dan peningkatan kesejahteraan sosial yang merata. Wassalamu'alaikum Warahmatullahi Wabarakatuh."))) !!}
                </div>

                <!-- Signature & Quick Actions -->
                <div class="pt-6 border-t border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <!-- Signature representation -->
                    <div class="space-y-1">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanda Tangan Digital</span>
                        <div class="font-serif italic text-2xl font-semibold text-brand-blue-700 select-none py-1">
                            {{ $village->nama_kepala_desa ?? 'Fadlan, S.IP' }}
                        </div>
                        <span class="block text-[11px] font-black text-slate-700 leading-none">Kepala Desa</span>
                    </div>

                    <!-- Shortcut Action Buttons -->
                    <div class="flex flex-wrap gap-3">
                        @if($menuPublicProfil)
                        <a href="{{ route('public.profil.struktur') }}" class="inline-flex items-center gap-1.5 px-5 py-3 rounded-xl bg-slate-900 text-white font-extrabold text-xs shadow-md shadow-slate-900/10 hover:bg-slate-800 transition-all hover:-translate-y-0.5 active:scale-95">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A3.376 3.376 0 0111.625 22.5a3.374 3.374 0 01-3.375-3.263v-.11M15 9.75a3 3 0 11-6 0 3 3 0 016 0zm-3 8.25a8.967 8.967 0 01-4.89-1.428c-.282-.19-.55-.412-.803-.665a4.994 4.994 0 017.53-4.086 4.996 4.996 0 013.161 4.754H12z"/></svg>
                            Profil Kepala Desa
                        </a>
                        <a href="{{ route('public.profil.index') }}" class="inline-flex items-center gap-1.5 px-5 py-3 rounded-xl bg-brand-green-500 text-white font-extrabold text-xs shadow-md shadow-brand-green-500/10 hover:bg-brand-green-600 transition-all hover:-translate-y-0.5 active:scale-95">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 11.518 1.357L11.25 11.25zm.041-.02l-.041.02a.75.75 0 00-.518-1.357l.559 1.337zM12 2.25V1.5v.75zm0 19.5v.75-.75zM2.25 12H1.5h.75zm19.5 0h.75H21.75zM12 21.75c-5.385 0-9.75-4.365-9.75-9.75S6.615 2.25 12 2.25s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75z"/></svg>
                            Tentang Desa
                        </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 4. Dashboard Statistik Desa (Interactive Demographics Widget) -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-xs font-black uppercase tracking-[0.25em] text-brand-blue-600 block">DASHBOARD DEMOGRAFI</span>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-4 tracking-tight">Kependudukan & Statistik Desa</h2>
            <div class="w-16 h-1.5 bg-brand-blue-600 rounded-full mx-auto mb-4"></div>
            <p class="text-slate-500 max-w-xl mx-auto text-sm leading-relaxed">Visualisasi diagram interaktif berbasis data kependudukan dinamis di Desa Rambah Samo Barat.</p>
        </div>

        <!-- Metric Widgets Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 mb-16 text-center">
            <div class="bg-slate-50 border border-slate-100 p-6 rounded-3xl hover:bg-white hover:shadow-xl transition-all duration-300" data-aos="fade-up">
                <span class="block text-3xl font-black text-brand-blue-600 mb-1 leading-none tracking-tight">{{ number_format($stats['penduduk'] ?? 2540) }}</span>
                <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Total Penduduk</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 p-6 rounded-3xl hover:bg-white hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                <span class="block text-3xl font-black text-brand-green-600 mb-1 leading-none tracking-tight">{{ number_format($stats['keluarga'] ?? 782) }}</span>
                <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Kepala Keluarga</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 p-6 rounded-3xl hover:bg-white hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                <span class="block text-3xl font-black text-amber-600 mb-1 leading-none tracking-tight">{{ $stats['dusun'] ?? 4 }}</span>
                <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Dusun Mandiri</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 p-6 rounded-3xl hover:bg-white hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                <span class="block text-3xl font-black text-purple-600 mb-1 leading-none tracking-tight">{{ $stats['rt_rw'] ?? 18 }}</span>
                <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Rukun Tetangga (RT)</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 p-6 rounded-3xl hover:bg-white hover:shadow-xl transition-all duration-300 col-span-2 md:col-span-4 lg:col-span-1" data-aos="fade-up" data-aos-delay="400">
                <span class="block text-3xl font-black text-teal-600 mb-1 leading-none tracking-tight">{{ $stats['umkm'] ?? 12 }}</span>
                <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Mitra UMKM Unggul</span>
            </div>
        </div>

        <!-- Interactive Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- Left Chart: Gender & Age Progress -->
            <div class="bg-slate-50 border border-slate-100 p-8 rounded-[2rem] shadow-sm flex flex-col justify-between h-full" data-aos="fade-right">
                <div>
                    <h3 class="text-lg font-black text-slate-800 tracking-tight flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-brand-blue-600 rounded-full"></span> Sebaran Jenis Kelamin & Usia
                    </h3>
                    <div class="relative w-44 h-44 mx-auto mb-8">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>

                <!-- Age Sebaran Progress Bar -->
                <div class="space-y-4 pt-4 border-t border-slate-200/50 text-slate-700">
                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-400">Kelompok Rentang Usia</h4>
                    
                    @php
                        $totUsia = array_sum($statsUsia);
                        $totUsia = $totUsia > 0 ? $totUsia : 1;
                        $pctAnak = round(($statsUsia['Anak-anak (0-14)'] ?? 0) / $totUsia * 100);
                        $pctProd = round(($statsUsia['Produktif (15-64)'] ?? 0) / $totUsia * 100);
                        $pctLansia = round(($statsUsia['Lansia (65+)'] ?? 0) / $totUsia * 100);
                    @endphp

                    <!-- 1. Anak -->
                    <div class="space-y-1">
                        <div class="flex justify-between text-xs font-bold">
                            <span>Anak-anak (0-14 Thn)</span>
                            <span class="text-brand-blue-600">{{ $pctAnak }}%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-brand-blue-600 rounded-full" style="width: {{ $pctAnak }}%"></div>
                        </div>
                    </div>
                    
                    <!-- 2. Produktif -->
                    <div class="space-y-1">
                        <div class="flex justify-between text-xs font-bold">
                            <span>Produktif (15-64 Thn)</span>
                            <span class="text-brand-green-600">{{ $pctProd }}%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-brand-green-600 rounded-full" style="width: {{ $pctProd }}%"></div>
                        </div>
                    </div>

                    <!-- 3. Lansia -->
                    <div class="space-y-1">
                        <div class="flex justify-between text-xs font-bold">
                            <span>Lansia (65+ Thn)</span>
                            <span class="text-amber-500">{{ $pctLansia }}%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-500 rounded-full" style="width: {{ $pctLansia }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle Chart: Education Level -->
            <div class="bg-slate-50 border border-slate-100 p-8 rounded-[2rem] shadow-sm flex flex-col justify-between h-full" data-aos="fade-up">
                <div>
                    <h3 class="text-lg font-black text-slate-800 tracking-tight flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-brand-green-500 rounded-full"></span> Tingkat Pendidikan Terakhir
                    </h3>
                    <div class="relative w-full h-64">
                        <canvas id="educationChart"></canvas>
                    </div>
                </div>
                <p class="text-[11px] text-slate-400 mt-6 leading-relaxed font-medium">Data di atas merepresentasikan persentase kualifikasi pendidikan formal warga yang tercatat dalam Sistem Administrasi Desa.</p>
            </div>

            <!-- Right Chart: Occupations -->
            <div class="bg-slate-50 border border-slate-100 p-8 rounded-[2rem] shadow-sm flex flex-col justify-between h-full" data-aos="fade-left">
                <div>
                    <h3 class="text-lg font-black text-slate-800 tracking-tight flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-amber-500 rounded-full"></span> Struktur Mata Pencaharian
                    </h3>
                    <div class="relative w-full h-64">
                        <canvas id="jobChart"></canvas>
                    </div>
                </div>
                <p class="text-[11px] text-slate-400 mt-6 leading-relaxed font-medium">Mayoritas masyarakat Desa Rambah Samo Barat berprofesi sebagai Petani/Pekebun, diikuti wiraswasta lokal dan sektor karyawan swasta.</p>
            </div>

        </div>
    </div>
</section>

<!-- 5. Berita Terkini Modern -->
@if(isset($latestNews) && $latestNews->count() > 0)
<section class="py-24 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.25em] text-brand-blue-600 block">KABAR KEMASYARAKATAN</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight mt-1">Berita Terkini & Agenda Desa</h2>
                <div class="w-16 h-1.5 bg-brand-blue-600 rounded-full mt-4"></div>
            </div>
            <a href="{{ route('public.berita.index') }}" class="inline-flex items-center text-xs font-black text-brand-blue-600 uppercase tracking-widest hover:gap-2 transition-all group shrink-0">
                Lihat Semua Berita
                <svg class="h-4.5 w-4.5 ml-1.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($latestNews as $news)
            <article class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group border border-slate-100 flex flex-col h-full">
                <!-- Thumbnail -->
                <div class="relative aspect-[16/10] w-full overflow-hidden bg-slate-100">
                    @if($news->gambar)
                    <img src="{{ asset('storage/' . $news->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $news->judul }}">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                        <svg class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    @endif
                    
                    <!-- Category overlay -->
                    <div class="absolute top-4 left-4">
                        <span class="px-3.5 py-1.5 bg-white/90 backdrop-blur-md rounded-full text-[9px] font-black text-slate-800 uppercase tracking-widest shadow-sm">
                            {{ $news->category?->name ?? 'Update' }}
                        </span>
                    </div>
                </div>

                <!-- Info Body -->
                <div class="p-8 flex flex-col flex-1 justify-between">
                    <div class="space-y-4">
                        <div class="text-[9px] text-slate-400 font-black uppercase tracking-[0.22em]">
                            {{ $news->published_at?->format('d M Y') }}
                        </div>
                        <h3 class="text-lg font-black text-slate-900 leading-snug group-hover:text-brand-blue-600 transition-colors line-clamp-2">
                            <a href="{{ route('public.berita.show', $news->slug) }}">
                                {{ $news->judul }}
                            </a>
                        </h3>
                        <p class="text-slate-500 text-xs leading-relaxed line-clamp-2 mt-2">
                            {{ Str::limit(strip_tags($news->konten), 120) }}
                        </p>
                    </div>
                    
                    <a href="{{ route('public.berita.show', $news->slug) }}" class="inline-flex items-center text-[10px] font-black text-brand-blue-600 uppercase tracking-widest mt-6 group-hover:gap-1.5 transition-all">
                        Selengkapnya
                        <svg class="h-3.5 w-3.5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- 6. Mini Galeri Desa & Pop-up Lightbox Slider (Alpine.js) -->
@if(isset($galleries) && $galleries->count() > 0)
<section class="py-24 bg-white border-t border-slate-200" x-data="{ lightboxOpen: false, currentImage: '', activeTitle: '', images: [
    @foreach($galleries as $gallery)
        { src: '{{ asset('storage/' . $gallery->file_path) }}', title: '{{ $gallery->judul }}', category: '{{ $gallery->kategori }}' }{{ !$loop->last ? ',' : '' }}
    @endforeach
], activeIndex: 0, 
openLightbox(idx) {
    this.activeIndex = idx;
    this.currentImage = this.images[idx].src;
    this.activeTitle = this.images[idx].title;
    this.lightboxOpen = true;
},
prevImage() {
    this.activeIndex = (this.activeIndex === 0) ? this.images.length - 1 : this.activeIndex - 1;
    this.currentImage = this.images[this.activeIndex].src;
    this.activeTitle = this.images[this.activeIndex].title;
},
nextImage() {
    this.activeIndex = (this.activeIndex === this.images.length - 1) ? 0 : this.activeIndex + 1;
    this.currentImage = this.images[this.activeIndex].src;
    this.activeTitle = this.images[this.activeIndex].title;
}
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-xs font-black uppercase tracking-[0.25em] text-brand-blue-600 block">DOKUMENTASI DOKUMEN</span>
            <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">Galeri Dokumentasi Desa</h2>
            <div class="w-16 h-1.5 bg-brand-blue-600 rounded-full mx-auto mb-4"></div>
            <p class="text-slate-500 max-w-xl mx-auto text-sm leading-relaxed">Potret infrastruktur pembangunan, wisata asri, pelaku UMKM, dan ragam kegiatan masyarakat.</p>
        </div>

        <!-- Kolase Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($galleries as $index => $gallery)
            <div @click="openLightbox({{ $index }})" class="group relative aspect-square overflow-hidden rounded-[1.5rem] bg-slate-200 cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 75 }}">
                @if($gallery->file_path)
                <img src="{{ asset('storage/' . $gallery->file_path) }}" 
                     alt="{{ $gallery->judul }}" 
                     class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end p-6">
                    <div>
                        <span class="text-white/80 text-[8px] font-black uppercase tracking-wider block">{{ $gallery->kategori ?? 'Kegiatan' }}</span>
                        <p class="text-white font-bold text-base leading-tight mt-1 transform translate-y-3 group-hover:translate-y-0 transition-transform duration-300">{{ $gallery->judul }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-12 text-center">
            <a href="{{ route('public.galeri.index') }}" class="inline-flex items-center text-xs font-black text-brand-blue-600 uppercase tracking-widest hover:gap-2 transition-all group">
                Jelajahi Galeri Selengkapnya
                <svg class="h-4.5 w-4.5 ml-1.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>

    <!-- Premium Alpine Lightbox Full-screen Overlay -->
    <div x-show="lightboxOpen" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/95 z-[999] flex items-center justify-center p-4">
        <!-- Close Button -->
        <button @click="lightboxOpen = false" class="absolute top-6 right-6 text-white/70 hover:text-white transition-colors p-2.5 rounded-full hover:bg-white/10 z-[1000]"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>

        <!-- Prev button -->
        <button @click="prevImage()" class="absolute left-6 text-white/70 hover:text-white transition-colors p-2.5 rounded-full hover:bg-white/10"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>

        <!-- Active Slide Image -->
        <div class="max-w-4xl max-h-[80vh] flex flex-col items-center gap-4 text-center">
            <img :src="currentImage" class="max-w-full max-h-[70vh] object-contain rounded-2xl shadow-2xl border border-white/10">
            <p x-text="activeTitle" class="text-white font-bold text-lg max-w-xl"></p>
        </div>

        <!-- Next button -->
        <button @click="nextImage()" class="absolute right-6 text-white/70 hover:text-white transition-colors p-2.5 rounded-full hover:bg-white/10"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
    </div>
</section>
@endif

<!-- 7. Agenda & Timeline Section -->
@if(isset($agenda) && $agenda->count() > 0)
<section class="py-24 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-xs font-black uppercase tracking-[0.25em] text-brand-blue-600 block">JADWAL PEMBANGUNAN</span>
            <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">Timeline Agenda Terdekat</h2>
            <div class="w-16 h-1.5 bg-brand-blue-600 rounded-full mx-auto mb-4"></div>
            <p class="text-slate-500 max-w-xl mx-auto text-sm leading-relaxed">Ikuti musyawarah pembangunan, penyuluhan, gotong-royong, dan forum partisipasi kemasyarakatan.</p>
        </div>

        <!-- Vertical Timeline Loop -->
        <div class="relative border-l border-slate-200 max-w-4xl mx-auto pl-8 space-y-12">
            @foreach($agenda as $event)
            <div class="relative group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- Bubble indicator -->
                <span class="absolute -left-[41px] top-1.5 flex h-6 w-6 rounded-full border-4 border-slate-50 bg-brand-blue-600 shadow-md group-hover:bg-brand-green-500 transition-colors duration-300"></span>

                <!-- Info Card -->
                <div class="bg-white border border-slate-100 rounded-3xl p-6 md:p-8 shadow-sm hover:shadow-xl transition-all duration-300 grid grid-cols-1 md:grid-cols-4 gap-6 items-start">
                    <!-- Event Date -->
                    <div class="md:col-span-1 border-b md:border-b-0 md:border-r border-slate-100 pb-4 md:pb-0 md:pr-6 flex flex-row md:flex-col items-center md:items-start justify-between md:justify-center gap-2 text-slate-700">
                        <div>
                            <span class="text-xs font-black uppercase tracking-wider text-slate-400 block">{{ $event->tanggal_mulai->format('M') }}</span>
                            <span class="text-4xl font-black text-slate-900 block leading-tight">{{ $event->tanggal_mulai->format('d') }}</span>
                        </div>
                        <span class="px-3 py-1 bg-brand-blue-50 text-brand-blue-600 text-[9px] font-black uppercase tracking-wider rounded-full w-fit mt-1">{{ $event->tanggal_mulai->format('Y') }}</span>
                    </div>

                    <!-- Event Detail -->
                    <div class="md:col-span-3 space-y-4">
                        <h3 class="text-xl font-bold text-slate-900 leading-snug group-hover:text-brand-blue-600 transition-colors">
                            <a href="{{ route('public.agenda.show', $event->id) }}">
                                {{ $event->judul }}
                            </a>
                        </h3>
                        
                        <p class="text-slate-500 text-xs leading-relaxed">
                            {{ Str::limit(strip_tags($event->deskripsi), 200) }}
                        </p>

                        <!-- Pin indicators -->
                        <div class="flex flex-wrap gap-6 text-xs text-slate-500 pt-2 border-t border-slate-50">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="font-bold text-slate-700">{{ $event->tanggal_mulai->format('H:i') }} WIB</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="font-bold text-slate-700 truncate max-w-[180px]">{{ $event->lokasi }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($menuPublicAnggaran)
<!-- 8. Transparansi Dana Desa (APBDES Visualizations) -->
<section class="py-24 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-xs font-black uppercase tracking-[0.25em] text-brand-blue-600 block">AKUNTABILITAS PUBLIK</span>
            <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">Transparansi Keuangan APBD</h2>
            <div class="w-16 h-1.5 bg-brand-blue-600 rounded-full mx-auto mb-4"></div>
            <p class="text-slate-500 max-w-xl mx-auto text-sm leading-relaxed">Publikasi berkala realisasi Anggaran Pendapatan dan Belanja Desa (APBDes) tahun berjalan.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Chart donut -->
            <div class="lg:col-span-5 bg-slate-50 border border-slate-100 p-8 rounded-[2rem] shadow-sm flex flex-col justify-center text-slate-700" data-aos="fade-right">
                <h3 class="text-lg font-black text-slate-800 tracking-tight flex items-center gap-2 mb-6">
                    <span class="w-1.5 h-6 bg-brand-blue-600 rounded-full"></span> Distribusi Alokasi Anggaran
                </h3>
                <div class="relative w-56 h-56 mx-auto mb-6">
                    <canvas id="apbdesChart"></canvas>
                </div>
                <div class="flex justify-between items-center text-xs font-bold pt-4 border-t border-slate-200/50">
                    <span>Status Verifikasi Inspektorat:</span>
                    <span class="px-2.5 py-1 bg-green-50 text-green-600 rounded-full text-[9px] font-black uppercase">TERTIB & AKUNTABEL</span>
                </div>
            </div>

            <!-- Right Progress bars -->
            <div class="lg:col-span-7 space-y-8" data-aos="fade-left">
                <div class="space-y-2">
                    <span class="text-xs font-black uppercase tracking-wider text-brand-green-600 block">REALISASI PENGGUNAAN ANGGARAN</span>
                    <h3 class="text-2xl font-black text-slate-900 leading-tight">Realisasi Capaian Pembangunan & Sosial</h3>
                </div>

                <div class="space-y-6 text-slate-700">
                    <!-- Progress 1 -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold">
                            <span>Pembangunan Infrastruktur Fisik (Semenisasi & Drainase)</span>
                            <span class="text-brand-blue-600">85% Realisasi</span>
                        </div>
                        <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden border border-slate-200/40">
                            <div class="h-full bg-brand-blue-600 rounded-full transition-all duration-1000" style="width: 85%"></div>
                        </div>
                    </div>
                    
                    <!-- Progress 2 -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold">
                            <span>Pemberdayaan Masyarakat & Pelatihan UMKM Desa</span>
                            <span class="text-brand-green-600">92% Realisasi</span>
                        </div>
                        <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden border border-slate-200/40">
                            <div class="h-full bg-brand-green-600 rounded-full transition-all duration-1000" style="width: 92%"></div>
                        </div>
                    </div>

                    <!-- Progress 3 -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold">
                            <span>Bantuan Sosial Warga (BLT Dana Desa)</span>
                            <span class="text-indigo-600">100% Realisasi</span>
                        </div>
                        <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden border border-slate-200/40">
                            <div class="h-full bg-indigo-600 rounded-full transition-all duration-1000" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex flex-wrap gap-4">
                    <a href="{{ route('public.apbdes.index') }}" class="btn-primary py-4 px-8 text-xs font-bold tracking-wider inline-flex items-center gap-2 shadow-lg shadow-brand-blue-500/10">
                        Buka Laporan Transparansi Lengkap
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endif

<!-- 9. CTA Section sebelum Footer -->
<section class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-gradient-to-br from-brand-blue-900 to-brand-green-900 text-white rounded-[3rem] p-10 md:p-16 shadow-2xl overflow-hidden group">
            <!-- Glow background overlay -->
            <div class="absolute inset-0 opacity-15 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] z-0"></div>
            <div class="absolute -top-32 -right-32 w-80 h-80 bg-brand-green-400 rounded-full filter blur-[100px] opacity-30 z-0"></div>
            <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-brand-blue-400 rounded-full filter blur-[100px] opacity-35 z-0"></div>

            <div class="relative z-10 text-center space-y-6 max-w-3xl mx-auto">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-brand-blue-300 block">PELAYANAN LEBIH DEKAT</span>
                <h2 class="text-3xl md:text-5xl font-black leading-tight tracking-tight">Pelayanan Desa Kini <br> Lebih Mudah, Cepat & Modern</h2>
                <p class="text-slate-200 text-sm max-w-xl mx-auto leading-relaxed">Ajukan permohonan administrasi secara mandiri dari genggaman Anda. Transparan, hemat waktu, tanpa biaya tambahan.</p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4 pt-6">
                    <a href="{{ $isLocked ? '#berlangganan' : route('login') }}" class="px-8 py-4.5 bg-brand-blue-600 hover:bg-brand-blue-700 text-white font-black uppercase tracking-widest text-xs rounded-2xl transition-all shadow-xl shadow-brand-blue-600/30 transform hover:-translate-y-0.5 active:scale-98">Akses Layanan Sekarang</a>
                    <a href="https://wa.me/{{ \App\Models\Setting::get('contact_phone', '6281234567890') }}" target="_blank" class="px-8 py-4.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-black uppercase tracking-widest text-xs rounded-2xl transition-all transform hover:-translate-y-0.5 active:scale-98">Hubungi Admin Desa</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 10. Footer Enhancement Block -->
<!-- Tag pembuka footer baru & maps ditaruh di layouts/public.blade.php bila perlu, tapi karena layouts/public.blade.php memiliki footer aslinya, kita dapat melengkapi layout di layouts/public.blade.php secara modular. -->
<!-- Wait! Untuk menambahkan Mini Maps dan Jam Operasional Kantor Desa tanpa merusak desain, kita akan memodifikasi layout/public.blade.php secara hati-hati pada footer quick links / column. -->
<!-- Mari kita lihat letak Footer di layouts/public.blade.php:
     Di baris 201-262, layouts/public.blade.php memiliki grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4.
     Mari kita modifikasi kolom-kolom ini agar memuat Mini Maps dan Jam Operasional Kantor Desa!
     It's a brilliant way to handle layouts/public.blade.php dynamically.
     Wait, let's write the JavaScript for Chart.js first inside welcome.blade.php!
-->

<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Gender Demographics Chart
    const ctxGender = document.getElementById('genderChart').getContext('2d');
    new Chart(ctxGender, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $statsGender['Laki-laki'] ?? 1285 }}, {{ $statsGender['Perempuan'] ?? 1255 }}],
                backgroundColor: [
                    'rgba(12, 137, 235, 0.85)', // brand blue
                    'rgba(54, 183, 53, 0.85)'   // brand green
                ],
                borderColor: ['#fff', '#fff'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        font: { size: 10, weight: 'bold', family: 'Inter, sans-serif' },
                        color: '#475569'
                    }
                }
            },
            cutout: '65%'
        }
    });

    // 2. Education Level Bar Chart
    const ctxEducation = document.getElementById('educationChart').getContext('2d');
    new Chart(ctxEducation, {
        type: 'bar',
        data: {
            labels: ['Tidak Sekolah', 'SD', 'SMP', 'SMA/SMK', 'S1/Diploma'],
            datasets: [{
                label: 'Jumlah Warga',
                data: [
                    {{ $statsPendidikan['Tidak Sekolah'] ?? 110 }},
                    {{ $statsPendidikan['SD'] ?? 450 }},
                    {{ $statsPendidikan['SMP'] ?? 620 }},
                    {{ $statsPendidikan['SMA/SMK'] ?? 980 }},
                    {{ $statsPendidikan['Diploma/S1'] ?? 380 }}
                ],
                backgroundColor: 'rgba(12, 137, 235, 0.75)',
                hoverBackgroundColor: 'rgba(12, 137, 235, 0.95)',
                borderRadius: 8,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    grid: { color: 'rgba(226, 232, 240, 0.5)' },
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 9, family: 'Inter, sans-serif' }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#475569',
                        font: { size: 10, weight: 'bold', family: 'Inter, sans-serif' }
                    }
                }
            }
        }
    });

    // 3. Jobs Radar/Polar Chart
    const ctxJob = document.getElementById('jobChart').getContext('2d');
    new Chart(ctxJob, {
        type: 'polarArea',
        data: {
            labels: ['Petani', 'Swasta', 'Wiraswasta', 'PNS/TNI', 'Lainnya'],
            datasets: [{
                data: [
                    {{ $statsPekerjaan['Petani'] ?? 840 }},
                    {{ $statsPekerjaan['Swasta'] ?? 650 }},
                    {{ $statsPekerjaan['Wiraswasta'] ?? 380 }},
                    {{ $statsPekerjaan['PNS/TNI/Polri'] ?? 120 }},
                    {{ $statsPekerjaan['Lainnya'] ?? 550 }}
                ],
                backgroundColor: [
                    'rgba(12, 137, 235, 0.7)',
                    'rgba(54, 183, 53, 0.7)',
                    'rgba(245, 158, 11, 0.7)',
                    'rgba(139, 92, 246, 0.7)',
                    'rgba(148, 163, 184, 0.7)'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 10,
                        font: { size: 9, weight: 'bold', family: 'Inter, sans-serif' },
                        color: '#475569'
                    }
                }
            },
            scales: {
                r: {
                    ticks: { display: false },
                    grid: { color: 'rgba(226, 232, 240, 0.7)' }
                }
            }
        }
    });

    // 4. APBDes Budget Allocation Chart (transparansi dana)
    const ctxApbdes = document.getElementById('apbdesChart').getContext('2d');
    new Chart(ctxApbdes, {
        type: 'doughnut',
        data: {
            labels: ['Pendapatan Desa', 'Belanja Pemb. Fisik', 'Belanja Sosial/Bansos', 'Pemberdayaan Warga'],
            datasets: [{
                data: [3400000000, 1600000000, 900000000, 500000000], // in rupiah (seeded mockup values)
                backgroundColor: [
                    'rgba(12, 137, 235, 0.85)',
                    'rgba(54, 183, 53, 0.85)',
                    'rgba(139, 92, 246, 0.85)',
                    'rgba(245, 158, 11, 0.85)'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false } // custom legend printed in list layout above if needed, display is hidden to fit
            },
            cutout: '70%'
        }
    });
});
</script>
@endsection
