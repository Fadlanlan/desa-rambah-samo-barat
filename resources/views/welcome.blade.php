@extends('layouts.public')

@section('title', 'Beranda - Desa Rambah Samo Barat')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
    <!-- Background Accents -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-brand-blue-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-96 h-96 bg-brand-green-100 rounded-full blur-3xl opacity-50"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center space-y-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-blue-50 border border-brand-blue-100 text-brand-blue-600 font-bold text-xs uppercase tracking-widest animate-fade-in">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-blue-600"></span>
                </span>
                Official Website Desa
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-slate-900 leading-tight">
                Membangun Desa <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-blue-600 to-brand-green-500">{{ $village->nama_desa ?? 'Rambah Samo Barat' }}</span>
            </h1>

            <p class="max-w-2xl mx-auto text-lg text-slate-600 leading-relaxed">
                {{ $village->visi ?? 'Mewujudkan tata kelola pemerintahan desa yang transparan, akuntabel, dan inovatif melaui transformasi digital untuk pelayanan publik yang prima.' }}
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4 pt-4">
                @if($isLocked)
                    <a href="#berlangganan" class="btn-primary py-4 px-12 text-base shadow-xl shadow-brand-blue-200">
                        Berlangganan Sekarang
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary py-4 px-8 text-sm">
                        Akses Layanan Mandiri
                    </a>
                    <a href="{{ route('public.berita.index') }}" class="btn-secondary py-4 px-8 text-sm bg-white !text-slate-700 border-slate-200 hover:bg-slate-50">
                        Baca Berita Desa
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

</section>

<!-- Pengumuman & Agenda Section -->
@if((isset($pengumuman) && $pengumuman->count() > 0) || (isset($agenda) && $agenda->count() > 0))
<section class="py-16 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Pengumuman Column -->
            <div class="{{ (isset($agenda) && $agenda->count() > 0) ? '' : 'lg:col-span-2' }}">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                        <span class="w-2 h-8 bg-amber-500 rounded-full"></span>
                        Pengumuman
                    </h2>
                    <a href="{{ route('public.pengumuman.index') }}" class="text-xs font-bold text-slate-500 hover:text-brand-blue-600 uppercase tracking-widest transition-colors">
                        Lihat Semua
                    </a>
                </div>

                @if(isset($pengumuman) && $pengumuman->count() > 0)
                    <div class="space-y-4">
                        @foreach($pengumuman as $info)
                        <div class="group relative bg-amber-50/50 border border-amber-100 rounded-2xl p-6 hover:bg-amber-50 transition-colors">
                            <div class="absolute top-6 right-6 text-amber-300 group-hover:text-amber-400 transition-colors">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                            </div>
                            <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-bold uppercase tracking-widest rounded-full mb-3">
                                {{ $info->created_at->format('d M Y') }}
                            </span>
                            <h3 class="text-lg font-bold text-slate-900 mb-2 leading-snug pr-8">
                                <a href="{{ route('public.pengumuman.show', $info->id) }}" class="hover:text-amber-600 transition-colors">
                                    {{ $info->judul }}
                                </a>
                            </h3>
                            <p class="text-sm text-slate-600 line-clamp-2 leading-relaxed mb-4">
                                {{ Str::limit(strip_tags($info->konten), 120) }}
                            </p>
                            <a href="{{ route('public.pengumuman.show', $info->id) }}" class="inline-flex items-center text-xs font-bold text-amber-600 uppercase tracking-widest hover:gap-1 transition-all group-hover:underline">
                                Selengkapnya
                                <svg class="w-3 h-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 border-2 border-dashed border-slate-200 rounded-2xl text-center">
                        <p class="text-slate-400 text-sm font-medium italic">Belum ada pengumuman terbaru.</p>
                    </div>
                @endif
            </div>

            <!-- Agenda Column -->
            @if(isset($agenda) && $agenda->count() > 0)
            <div>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                        <span class="w-2 h-8 bg-brand-blue-500 rounded-full"></span>
                        Agenda Kegiatan
                    </h2>
                    <a href="{{ route('public.agenda.index') }}" class="text-xs font-bold text-slate-500 hover:text-brand-blue-600 uppercase tracking-widest transition-colors">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-4">
                    @foreach($agenda as $event)
                    <div class="group flex gap-4 bg-slate-50 border border-slate-100 rounded-2xl p-4 hover:bg-white hover:shadow-lg transition-all duration-300">
                        <!-- Date Badge -->
                        <div class="flex flex-col items-center justify-center w-16 h-20 bg-white border border-slate-200 rounded-xl shadow-sm group-hover:border-brand-blue-200 group-hover:bg-brand-blue-50 transition-colors">
                            <span class="text-xs font-bold text-brand-blue-600 uppercase tracking-widest mb-0.5">{{ $event->tanggal_mulai->format('M') }}</span>
                            <span class="text-2xl font-black text-slate-900">{{ $event->tanggal_mulai->format('d') }}</span>
                        </div>
                        
                        <div class="flex-1 min-w-0 py-1">
                            <h3 class="text-base font-bold text-slate-900 mb-1 leading-tight truncate group-hover:text-brand-blue-600 transition-colors">
                                <a href="{{ route('public.agenda.show', $event->id) }}">
                                    {{ $event->judul }}
                                </a>
                            </h3>
                            <div class="flex items-center gap-4 text-xs text-slate-500 mb-2">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $event->tanggal_mulai->format('H:i') }} WIB
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="truncate max-w-[120px]">{{ $event->lokasi }}</span>
                                </div>
                            </div>
                            <a href="{{ route('public.agenda.show', $event->id) }}" class="text-[10px] font-bold text-brand-blue-600 uppercase tracking-wide hover:underline">
                                Lihat Detail Agenda
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
@endif

@if(!$isLocked)
<!-- Latest News Section -->
@if(isset($latestNews) && $latestNews->count() > 0)
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <h2 class="text-3xl lg:text-4xl font-black text-slate-900 mb-4 tracking-tight">Berita Terkini</h2>
                <div class="w-20 h-1.5 bg-brand-blue-600 rounded-full"></div>
            </div>
            <a href="{{ route('public.berita.index') }}" class="inline-flex items-center text-sm font-black text-brand-blue-600 uppercase tracking-widest hover:gap-2 transition-all group">
                Lihat Semua Berita
                <svg class="h-5 w-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($latestNews as $news)
            <article class="bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group border border-slate-100 flex flex-col h-full">
                <div class="relative h-56 overflow-hidden">
                    @if($news->gambar)
                    <img src="{{ asset('storage/' . $news->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $news->judul }}">
                    @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                        <svg class="h-12 w-12 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md rounded-full text-[10px] font-bold text-slate-900 uppercase tracking-widest shadow-sm">
                            {{ $news->category?->name ?? 'Update' }}
                        </span>
                    </div>
                </div>
                <div class="p-8 flex flex-col flex-1">
                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mb-4">
                        {{ $news->published_at?->format('d M Y') }}
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 leading-snug mb-4 group-hover:text-brand-blue-600 transition-colors flex-1">
                        <a href="{{ route('public.berita.show', $news->slug) }}">
                            {{ \Illuminate\Support\Str::limit($news->judul, 60) }}
                        </a>
                    </h3>
                    <a href="{{ route('public.berita.show', $news->slug) }}" class="inline-flex items-center text-xs font-black text-brand-blue-600 uppercase tracking-widest group-hover:gap-2 transition-all">
                        Selengkapnya
                        <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endif

<!-- Features / Service Stats -->
<section class="py-24 bg-white border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">Layanan Digital Desa</h2>
            <p class="text-slate-500 max-w-xl mx-auto">Akses berbagai layanan publik desa dengan mudah dan cepat melalui sistem informasi terpadu.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card 1 -->
            <a href="{{ $isLocked ? '#berlangganan' : route('login') }}" class="card p-8 group hover:-translate-y-2 transition-all" data-aos="fade-up" data-aos-delay="0">
                <div class="w-12 h-12 rounded-xl bg-brand-blue-50 flex items-center justify-center text-brand-blue-600 mb-6 transition-colors group-hover:bg-brand-blue-600 group-hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Surat Digital</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Pengajuan berbagai macam surat keterangan desa secara online dan praktis.</p>
            </a>

            <!-- Card 2 -->
            <div class="card p-8 group hover:-translate-y-2 transition-all" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 rounded-xl bg-brand-green-50 flex items-center justify-center text-brand-green-600 mb-6 transition-colors group-hover:bg-brand-green-600 group-hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Data Penduduk</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Integrasi data kependudukan yang aman dan memudahkan pendataan warga.</p>
            </div>

            <!-- Card 3 -->
            <a href="{{ $isLocked ? '#berlangganan' : route('public.pengaduan.create') }}" class="card p-8 group hover:-translate-y-2 transition-all" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 mb-6 transition-colors group-hover:bg-amber-600 group-hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Pengaduan</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Sampaikan aspirasi dan aduan Anda untuk perbaikan layanan desa.</p>
            </a>

            <!-- Card 4 -->
            <a href="{{ route('public.berita.index') }}" class="card p-8 group hover:-translate-y-2 transition-all" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 mb-6 transition-colors group-hover:bg-purple-600 group-hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Informasi Publik</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Berita terkini, pengumuman resmi, dan transparansi anggaran desa.</p>
            </a>
        </div>
    </div>
</section>

<!-- Galeri Section -->
@if(isset($galleries) && $galleries->count() > 0)
<section class="py-24 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">Galeri Desa</h2>
            <p class="text-slate-500 max-w-xl mx-auto">Dokumentasi kegiatan dan potensi Desa Rambah Samo Barat.</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($galleries as $gallery)
            <div class="group relative aspect-square overflow-hidden rounded-xl bg-slate-200 cursor-pointer" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
                @if($gallery->file_path)
                <img src="{{ asset('storage/' . $gallery->file_path) }}" 
                     alt="{{ $gallery->judul }}" 
                     class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end p-6">
                    <div>
                        <p class="text-white font-bold text-lg leading-tight transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">{{ $gallery->judul }}</p>
                        @if($gallery->kategori)
                        <p class="text-white/80 text-xs uppercase tracking-wider mt-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">{{ $gallery->kategori }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-12 text-center" data-aos="fade-up">
            <a href="{{ route('public.galeri.index') }}" class="inline-flex items-center text-sm font-black text-brand-blue-600 uppercase tracking-widest hover:gap-2 transition-all group">
                Lihat Semua Foto
                <svg class="h-5 w-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- UMKM Section -->
@if(isset($umkms) && $umkms->count() > 0)
<section class="py-24 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">UMKM Desa</h2>
            <p class="text-slate-500 max-w-xl mx-auto">Mendukung pertumbuhan ekonomi lokal melalui pemberdayaan UMKM.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
            @foreach($umkms as $umkm)
            <div class="group rounded-2xl border border-slate-100 bg-white p-4 shadow-sm transition hover:shadow-xl hover:-translate-y-1 duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="aspect-video w-full overflow-hidden rounded-xl bg-slate-100 mb-6 relative">
                    @if($umkm->foto)
                    <img src="{{ asset('storage/' . $umkm->foto) }}" alt="{{ $umkm->nama_usaha }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                    @else
                    <div class="flex h-full w-full items-center justify-center text-slate-300">
                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    @endif
                    
                    @if($umkm->kategori)
                    <div class="absolute top-3 left-3">
                         <span class="inline-flex items-center rounded-md bg-white/90 backdrop-blur px-2.5 py-1 text-xs font-bold text-slate-900 shadow-sm">
                            {{ $umkm->kategori }}
                        </span>
                    </div>
                    @endif
                </div>
                
                <h3 class="font-bold text-lg md:text-xl text-slate-900 mb-1 group-hover:text-brand-blue-600 transition-colors line-clamp-1">{{ $umkm->nama_usaha }}</h3>
                <p class="text-xs md:text-sm text-slate-500 mb-4">{{ $umkm->pemilik }}</p>
                
                <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                     @if($umkm->no_hp)
                    <a href="https://wa.me/{{ $umkm->no_hp }}" target="_blank" class="text-xs md:text-sm font-semibold text-green-600 hover:text-green-700 flex items-center gap-2 bg-green-50 px-3 py-1.5 rounded-lg transition-colors">
                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        Chat
                    </a>
                    @else
                    <span class="text-xs text-slate-400 font-medium">No Contact</span>
                    @endif
                    
                    <a href="{{ route('public.umkm.index') }}" class="text-[10px] md:text-xs font-bold text-slate-900 uppercase tracking-wider hover:text-brand-blue-600 transition-colors">Detail</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center" data-aos="fade-up">
            <a href="{{ route('public.umkm.index') }}" class="inline-flex items-center text-sm font-black text-brand-blue-600 uppercase tracking-widest hover:gap-2 transition-all group">
                Lihat Semua UMKM
                <svg class="h-5 w-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Wisata Section -->
@if(isset($wisatas) && $wisatas->count() > 0)
<section class="py-24 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <h2 class="text-3xl lg:text-4xl font-black text-slate-900 mb-4 tracking-tight">Wisata Desa</h2>
                <div class="w-20 h-1.5 bg-brand-green-500 rounded-full"></div>
            </div>
            <a href="{{ route('public.wisata.index') }}" class="inline-flex items-center text-sm font-black text-brand-blue-600 uppercase tracking-widest hover:gap-2 transition-all group">
                Jelajahi Semua Wisata
                <svg class="h-5 w-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            @foreach($wisatas as $wisata)
            <div class="group relative rounded-[2rem] overflow-hidden bg-white shadow-sm hover:shadow-2xl transition-all duration-500 border border-slate-100 flex flex-col h-full" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="aspect-[16/10] overflow-hidden">
                    @if($wisata->gambar)
                    <img src="{{ asset('storage/' . $wisata->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $wisata->nama }}">
                    @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                        <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    @endif
                </div>
                <div class="p-4 md:p-8 flex flex-col flex-1">
                    <div class="flex items-center gap-2 mb-2 md:mb-4">
                        <span class="px-2 py-0.5 md:px-3 md:py-1 bg-brand-green-50 text-brand-green-600 rounded-full text-[8px] md:text-[10px] font-bold uppercase tracking-widest">Destinasi</span>
                        @if($wisata->harga_tiket)
                        <span class="text-[8px] md:text-[10px] font-bold text-slate-400 uppercase tracking-widest">Rp {{ $wisata->harga_tiket }}</span>
                        @endif
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-slate-900 mb-2 md:mb-3 group-hover:text-brand-blue-600 transition-colors line-clamp-1">
                        <a href="{{ route('public.wisata.show', $wisata->slug) }}">{{ $wisata->nama }}</a>
                    </h3>
                    <p class="text-slate-500 text-xs md:text-sm mb-4 md:mb-6 line-clamp-2 leading-relaxed flex-1">
                        {{ $wisata->deskripsi }}
                    </p>
                    <a href="{{ route('public.wisata.show', $wisata->slug) }}" class="inline-flex items-center text-[10px] md:text-xs font-black text-brand-blue-600 uppercase tracking-widest group-hover:gap-2 transition-all">
                        Lihat Detail
                        <svg class="h-3 w-3 md:h-4 md:w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(!$isLocked)
<!-- Stats Wrapper -->
<div class="bg-gradient-to-br from-brand-blue-900 to-brand-green-900 py-24 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 text-center">
            <div>
                <span class="block text-4xl lg:text-5xl font-extrabold mb-3 tracking-tighter">{{ number_format($stats['penduduk'] ?? 2540) }}</span>
                <span class="text-brand-blue-200 font-bold uppercase text-[10px] tracking-[0.2em]">Total Penduduk</span>
            </div>
            <div>
                <span class="block text-4xl lg:text-5xl font-extrabold mb-3 tracking-tighter">{{ number_format($stats['keluarga'] ?? 782) }}</span>
                <span class="text-brand-blue-200 font-bold uppercase text-[10px] tracking-[0.2em]">Kepala Keluarga</span>
            </div>
            <div>
                <span class="block text-4xl lg:text-5xl font-extrabold mb-3 tracking-tighter">{{ $stats['program'] ?? 12 }}</span>
                <span class="text-brand-blue-200 font-bold uppercase text-[10px] tracking-[0.2em]">Program Desa</span>
            </div>
            <div>
                <span class="block text-4xl lg:text-5xl font-extrabold mb-3 tracking-tighter">{{ $stats['transparansi'] ?? '100%' }}</span>
                <span class="text-brand-blue-200 font-bold uppercase text-[10px] tracking-[0.2em]">Transparansi</span>
            </div>
        </div>
    </div>
</div>
@endif

@if($isLocked)
<!-- Section Berlangganan / Promosi -->
<section id="berlangganan" class="py-24 bg-slate-50 overflow-hidden scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-blue-50 border border-brand-blue-100 text-brand-blue-600 font-bold text-xs uppercase tracking-widest mb-6">
                Premium Experience
            </div>
            <h2 class="text-4xl lg:text-6xl font-black text-slate-900 mb-6 tracking-tight leading-tight">
                Transformasi Digital <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-blue-600 to-brand-green-500">Tanpa Batas</span>
            </h2>
            <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
                Rasakan pengalaman mengelola desa yang modern, cepat, dan transparan. Bergabunglah dengan puluhan desa lainnya yang telah beralih ke layanan digital premium.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <!-- Left: Experience Section -->
            <div class="space-y-8" data-aos="fade-right">
                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden group">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-brand-blue-50 rounded-full blur-2xl group-hover:bg-brand-blue-100 transition-colors"></div>
                    
                    <h3 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                        <span class="p-2 bg-brand-blue-600 text-white rounded-lg">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </span>
                        Manfaat Untuk Warga
                    </h3>
                    
                    <div class="space-y-6">
                        <div class="flex gap-5">
                            <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-brand-blue-50 flex items-center justify-center text-brand-blue-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 mb-1 leading-tight">Layanan 24/7 Tanpa Antri</h4>
                                <p class="text-sm text-slate-500">Ajukan surat keterangan atau lapor masalah kapan saja dan di mana saja. Tidak perlu menunggu jam kantor.</p>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-brand-green-50 flex items-center justify-center text-brand-green-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 mb-1 leading-tight">Transparansi Real-Time</h4>
                                <p class="text-sm text-slate-500">Pantau status permohonan Anda secara langsung melalui sistem pelacakan otomatis yang transparan.</p>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 004.254 11H3m15.357 5.118L18.36 14.6l.054-.09a10.003 10.003 0 002.335-5.51H21m-2.144-5.113a10.016 10.016 0 01-2.853 0M10.5 4.5l-.054.09A10.003 10.003 0 008.11 10.1l-.054.09m4.887-5.187a10.016 10.016 0 013.132 0M9 21h6m-3-3v3m0-6a1 1 0 110-2 1 1 0 010 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 mb-1 leading-tight">Keamanan Data Terjamin</h4>
                                <p class="text-sm text-slate-500">Data kependudukan Anda dilindungi dengan enkripsi tingkat tinggi untuk kenyamanan privasi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-6 pt-4">
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20tertarik%20untuk%20berlangganan%20layanan%20surat%20dan%20admin%20desa." target="_blank" class="btn-primary py-5 px-12 text-lg shadow-2xl shadow-brand-blue-200 w-full sm:w-auto">
                        Mulai Berlangganan
                    </a>
                    <div class="flex -space-x-3 overflow-hidden">
                        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80" alt="">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full ring-2 ring-white bg-slate-100 text-xs font-bold text-slate-500">+12 Desa</span>
                    </div>
                </div>
            </div>

            <!-- Right: Admin Features -->
            <div class="relative" data-aos="fade-left">
                <div class="bg-slate-900 rounded-[3rem] p-10 lg:p-14 text-white shadow-2xl relative z-10 border border-white/5">
                    <h3 class="text-3xl font-black mb-10 pb-6 border-b border-white/10 flex items-center gap-4">
                        <span class="text-brand-blue-400 uppercase tracking-widest text-sm font-bold">Admin Experience</span>
                    </h3>
                    
                    <ul class="grid grid-cols-1 gap-10">
                        <li class="group">
                            <div class="flex items-start gap-5">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-brand-blue-400 font-black text-xl group-hover:bg-brand-blue-600 group-hover:text-white transition-all duration-300">
                                    01
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-xl font-bold mb-2 text-white group-hover:text-brand-blue-300 transition-colors">Smart Dashboard</h5>
                                    <p class="text-base text-white/50 leading-relaxed">Kelola ribuan data penduduk secara instan. Fitur filter cerdas memudahkan pencarian KK dan biodata warga dalam hitungan detik.</p>
                                </div>
                            </div>
                        </li>
                        <li class="group">
                            <div class="flex items-start gap-5">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-brand-blue-400 font-black text-xl group-hover:bg-brand-blue-600 group-hover:text-white transition-all duration-300">
                                    02
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-xl font-bold mb-2 text-white group-hover:text-brand-blue-300 transition-colors">One-Click Surat</h5>
                                    <p class="text-base text-white/50 leading-relaxed">Ucapkan selamat tinggal pada pengetikan manual. Sistem secara otomatis mengisi template surat dengan data kependudukan yang valid.</p>
                                </div>
                            </div>
                        </li>
                        <li class="group">
                            <div class="flex items-start gap-5">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-brand-blue-400 font-black text-xl group-hover:bg-brand-blue-600 group-hover:text-white transition-all duration-300">
                                    03
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-xl font-bold mb-2 text-white group-hover:text-brand-blue-300 transition-colors">Engagement Monitoring</h5>
                                    <p class="text-base text-white/50 leading-relaxed">Lihat perkembangan desa melalui grafik statistik yang indah. Pantau keaktifan warga dalam memberikan aduan dan masukan.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Floating Elements -->
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-brand-green-500/20 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-brand-blue-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection
