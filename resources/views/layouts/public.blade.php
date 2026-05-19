<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Desa Rambah Samo Barat'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @php
        $primaryColor = \App\Models\Setting::get('theme_primary_color', '#0c89eb');
        $secondaryColor = \App\Models\Setting::get('theme_secondary_color', '#36b735');
        $primaryShades = \App\Helpers\ThemeHelper::generateShades($primaryColor);
        $secondaryShades = \App\Helpers\ThemeHelper::generateShades($secondaryColor);
    @endphp
    <style>
        :root {
            @foreach($primaryShades as $shade => $hex)
                --color-brand-blue-{{ $shade }}: {{ \App\Helpers\ThemeHelper::hexToRgbString($hex) }};
            @endforeach
            @foreach($secondaryShades as $shade => $hex)
                --color-brand-green-{{ $shade }}: {{ \App\Helpers\ThemeHelper::hexToRgbString($hex) }};
            @endforeach
        }
    </style>
</head>
@php
    $isSystemLocked = \App\Models\Setting::get('system_lock_user', '0') === '1';
    $menuPublicProfil = \App\Models\Setting::get('menu_public_profil', '1') === '1';
    $menuPublicBerita = \App\Models\Setting::get('menu_public_berita', '1') === '1';
    $menuPublicSurat = \App\Models\Setting::get('menu_public_surat', '1') === '1';
    $menuPublicAntrian = \App\Models\Setting::get('menu_public_antrian', '1') === '1';
    $menuPublicGaleri = \App\Models\Setting::get('menu_public_galeri', '1') === '1';
    $menuPublicPengaduan = \App\Models\Setting::get('menu_public_pengaduan', '1') === '1';
    $menuPublicAnggaran = \App\Models\Setting::get('menu_public_anggaran', '1') === '1';
    $copyrightText = \App\Models\Setting::get('copyright_text', '© ' . date('Y') . ' Desa Rambah Samo Barat. All Rights Reserved.');
@endphp
<body class="font-sans text-slate-900 antialiased bg-slate-50 selection:bg-brand-blue-500 selection:text-white">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav x-data="{ open: false, scrolled: false }" 
             @scroll.window="scrolled = (window.pageYOffset > 20)"
             class="fixed w-full z-50 transition-all duration-300"
             :class="scrolled ? 'glass py-2' : 'bg-transparent py-4'">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="flex items-center gap-3">
                                @if($village->logo)
                                    <img src="{{ Str::startsWith($village->logo, ['http://', 'https://']) ? $village->logo : asset('storage/' . $village->logo) }}" onerror="this.src='https://ui-avatars.com/api/?name=Desa&background=0D8ABC&color=fff'" class="block h-10 w-auto" alt="Logo">
                                @else
                                    <x-application-logo class="block h-10 w-auto fill-current text-brand-blue-600" />
                                @endif
                                <div class="flex flex-col">
                                    <span class="font-bold text-xl tracking-tight leading-none text-brand-blue-700">DESA</span>
                                    <span class="text-xs font-semibold text-brand-green-600 tracking-wider uppercase">{{ $village->nama_desa ?? 'RAMBAH SAMO BARAT' }}</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            Beranda
                        </x-nav-link>
                        @if($menuPublicProfil)
                        <div class="relative group" x-data="{ open: false }">
                            <button @mouseenter="open = true" @click="open = !open" 
                                    class="inline-flex items-center px-1 pt-1 border-b-2 transition duration-150 ease-in-out text-sm font-medium leading-5"
                                    :class="request()->routeIs('public.profil.*') ? 'border-brand-blue-500 text-brand-blue-600' : 'border-transparent text-gray-500 hover:text-brand-blue-600 hover:border-brand-blue-400 focus:outline-none'">
                                Profil Desa
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @mouseleave="open = false" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute left-0 mt-2 w-48 rounded-2xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none overflow-hidden z-50">
                                <div class="py-1">
                                    <a href="{{ route('public.profil.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-blue-50 {{ request()->routeIs('public.profil.index') ? 'bg-brand-blue-50 text-brand-blue-600' : '' }}">Profil Lengkap</a>
                                    <a href="{{ route('public.profil.sejarah') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-blue-50 {{ request()->routeIs('public.profil.sejarah') ? 'bg-brand-blue-50 text-brand-blue-600' : '' }}">Sejarah Desa</a>
                                    <a href="{{ route('public.profil.visi-misi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-blue-50 {{ request()->routeIs('public.profil.visi-misi') ? 'bg-brand-blue-50 text-brand-blue-600' : '' }}">Visi & Misi</a>
                                    <a href="{{ route('public.profil.struktur') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-blue-50 {{ request()->routeIs('public.profil.struktur') ? 'bg-brand-blue-50 text-brand-blue-600' : '' }}">Struktur Organisasi</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($menuPublicBerita)
                        <x-nav-link :href="route('public.berita.index')" :active="request()->routeIs('public.berita.*')">Berita</x-nav-link>
                        @endif

                        @if($menuPublicSurat && !$isSystemLocked)
                            <x-nav-link :href="route('public.surat.create')" :active="request()->routeIs('public.surat.*')">Layanan Surat</x-nav-link>
                        @endif

                        @if($menuPublicAntrian && !$isSystemLocked)
                            <x-nav-link :href="route('public.antrian.create')" :active="request()->routeIs('public.antrian.*')">Antrian</x-nav-link>
                        @endif

                        @if($menuPublicGaleri)
                        <x-nav-link :href="route('public.galeri.index')" :active="request()->routeIs('public.galeri.*')">Galeri</x-nav-link>
                        @endif

                        @if($menuPublicPengaduan && !$isSystemLocked)
                            <x-nav-link :href="route('public.pengaduan.create')" :active="request()->routeIs('public.pengaduan.*')">Pengaduan</x-nav-link>
                        @endif

                        @if($menuPublicAnggaran)
                        <!-- Menu Transparansi Dropdown -->
                        <div class="relative group" x-data="{ open: false }">
                            <button @mouseenter="open = true" @click="open = !open" 
                                    class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out"
                                    :class="request()->routeIs('public.transparansi.*') || request()->routeIs('public.apbdes.*') || request()->routeIs('public.realisasi.*') || request()->routeIs('public.pembangunan.*') ? 'border-brand-blue-500 text-brand-blue-600' : 'border-transparent text-gray-500 hover:text-brand-blue-600 hover:border-brand-blue-400 focus:outline-none'">
                                Transparansi
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @mouseleave="open = false" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute left-0 mt-2 w-56 rounded-2xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none overflow-hidden z-50">
                                <div class="py-1">
                                    <a href="{{ route('public.transparansi.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-brand-blue-50 {{ request()->routeIs('public.transparansi.index') ? 'bg-brand-blue-50 text-brand-blue-600 font-semibold' : '' }}">
                                        📊 Transparansi Informasi
                                    </a>
                                    <a href="{{ route('public.apbdes.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-brand-blue-50 {{ request()->routeIs('public.apbdes.index') ? 'bg-brand-blue-50 text-brand-blue-600 font-semibold' : '' }}">
                                        💰 APBDes Desa
                                    </a>
                                    <a href="{{ route('public.realisasi.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-brand-blue-50 {{ request()->routeIs('public.realisasi.index') ? 'bg-brand-blue-50 text-brand-blue-600 font-semibold' : '' }}">
                                        📈 Realisasi Anggaran
                                    </a>
                                    <a href="{{ route('public.pembangunan.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-brand-blue-50 {{ request()->routeIs('public.pembangunan.index') ? 'bg-brand-blue-50 text-brand-blue-600 font-semibold' : '' }}">
                                        🏗️ Laporan Pembangunan
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @guest
                            <a href="{{ $isSystemLocked ? route('home') . '#berlangganan' : route('login') }}" class="btn-primary">
                                {{ $isSystemLocked ? 'Berlangganan' : 'Masuk Layanan' }}
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn-secondary">
                                Dashboard
                            </a>
                        @endguest
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex w-12 h-12 items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" aria-label="Menu">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="sm:hidden bg-white/95 backdrop-blur-md shadow-lg border-t border-gray-100">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        Beranda
                    </x-responsive-nav-link>
                    @if($menuPublicProfil)
                    <div x-data="{ open: false }">
                        <x-responsive-nav-link @click="open = !open" class="cursor-pointer">
                            Profil Desa
                            <svg class="ml-1 h-4 w-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </x-responsive-nav-link>
                        <div x-show="open" class="pl-4 bg-slate-50">
                            <x-responsive-nav-link :href="route('public.profil.index')" :active="request()->routeIs('public.profil.index')">Profil Lengkap</x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('public.profil.sejarah')" :active="request()->routeIs('public.profil.sejarah')">Sejarah Desa</x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('public.profil.visi-misi')" :active="request()->routeIs('public.profil.visi-misi')">Visi & Misi</x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('public.profil.struktur')" :active="request()->routeIs('public.profil.struktur')">Struktur Organisasi</x-responsive-nav-link>
                        </div>
                    </div>
                    @endif

                    @if($menuPublicBerita)
                    <x-responsive-nav-link :href="route('public.berita.index')" :active="request()->routeIs('public.berita.*')">Berita</x-responsive-nav-link>
                    @endif

                    @if($menuPublicSurat && !$isSystemLocked)
                        <x-responsive-nav-link :href="route('public.surat.create')" :active="request()->routeIs('public.surat.*')">Layanan Surat</x-responsive-nav-link>
                    @endif

                    @if($menuPublicAntrian && !$isSystemLocked)
                        <x-responsive-nav-link :href="route('public.antrian.create')" :active="request()->routeIs('public.antrian.*')">Antrian</x-responsive-nav-link>
                    @endif

                    @if($menuPublicGaleri)
                    <x-responsive-nav-link :href="route('public.galeri.index')" :active="request()->routeIs('public.galeri.*')">Galeri</x-responsive-nav-link>
                    @endif

                    @if($menuPublicPengaduan && !$isSystemLocked)
                        <x-responsive-nav-link :href="route('public.pengaduan.create')" :active="request()->routeIs('public.pengaduan.*')">Pengaduan</x-responsive-nav-link>
                    @endif

                    @if($menuPublicAnggaran)
                    <!-- Mobile Transparansi Menu -->
                    <div class="border-t border-slate-100/50 pt-2 pb-2">
                        <div class="px-4 py-2 text-xs font-black uppercase tracking-widest text-brand-blue-600">
                            Transparansi
                        </div>
                        <div class="space-y-1">
                            <x-responsive-nav-link :href="route('public.transparansi.index')" :active="request()->routeIs('public.transparansi.index')">📊 Transparansi Informasi</x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('public.apbdes.index')" :active="request()->routeIs('public.apbdes.index')">💰 APBDes Desa</x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('public.realisasi.index')" :active="request()->routeIs('public.realisasi.index')">📈 Realisasi Anggaran</x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('public.pembangunan.index')" :active="request()->routeIs('public.pembangunan.index')">🏗️ Laporan Pembangunan</x-responsive-nav-link>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        @guest
                            <a href="{{ $isSystemLocked ? route('home') . '#berlangganan' : route('login') }}" class="block w-full text-center btn-primary py-3">
                                {{ $isSystemLocked ? 'Berlangganan' : 'Masuk Layanan' }}
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="block w-full text-center btn-secondary py-3">
                                Dashboard
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-slate-900 text-slate-300 pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 {{ $isSystemLocked ? 'lg:grid-cols-3' : 'lg:grid-cols-4' }} gap-12 mb-12 border-b border-slate-800 pb-12">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                             @if($village->logo)
                                 <img src="{{ Str::startsWith($village->logo, ['http://', 'https://']) ? $village->logo : asset('storage/' . $village->logo) }}" onerror="this.src='https://ui-avatars.com/api/?name=Desa&background=0D8ABC&color=fff'" class="block h-8 w-auto" alt="Logo">
                             @else
                                 <x-application-logo class="block h-8 w-auto fill-current text-white" />
                             @endif
                             <span class="font-bold text-lg tracking-tight text-white uppercase">{{ $village->nama_desa ?? 'Samo Barat' }}</span>
                        </div>
                        <p class="text-sm leading-relaxed">
                            Official Website Desa {{ $village->nama_desa ?? 'Rambah Samo Barat' }}. <br>
                            Mewujudkan tata kelola desa yang transparan, akuntabel, dan inovatif.
                        </p>
                        <div class="pt-4 border-t border-slate-800/80 space-y-2">
                            <span class="text-[10px] font-black uppercase tracking-wider text-brand-green-500 block">Jam Operasional Kantor</span>
                            <ul class="space-y-1 text-xs text-slate-400">
                                <li class="flex justify-between">
                                    <span>Senin - Kamis:</span>
                                    <span class="font-bold text-slate-300">08:00 - 15:30 WIB</span>
                                </li>
                                <li class="flex justify-between">
                                    <span>Jumat:</span>
                                    <span class="font-bold text-slate-300">08:00 - 16:00 WIB</span>
                                </li>
                                <li class="flex justify-between">
                                    <span>Sabtu - Minggu:</span>
                                    <span class="text-rose-500 font-bold">Tutup</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-white font-bold mb-6">Tautan Cepat</h4>
                        <ul class="space-y-3 text-sm">
                            @if($menuPublicProfil)
                                <li><a href="{{ route('public.profil.index') }}" class="hover:text-brand-blue-400 transition-colors">Profil Desa</a></li>
                            @endif
                            @if($isSystemLocked)
                                @if($menuPublicBerita)
                                    <li><a href="{{ route('public.berita.index') }}" class="hover:text-brand-blue-400 transition-colors">Berita Desa</a></li>
                                @endif
                                @if($menuPublicGaleri)
                                    <li><a href="{{ route('public.galeri.index') }}" class="hover:text-brand-blue-400 transition-colors">Galeri</a></li>
                                @endif
                                <li><a href="#berlangganan" class="hover:text-brand-blue-400 transition-colors font-bold text-brand-blue-400">Berlangganan</a></li>
                            @else
                                @if($menuPublicPengaduan)
                                    <li><a href="{{ route('public.pengaduan.create') }}" class="hover:text-brand-blue-400 transition-colors">Layanan Pengaduan</a></li>
                                @endif
                                @if($menuPublicAntrian)
                                    <li><a href="{{ route('public.antrian.create') }}" class="hover:text-brand-blue-400 transition-colors">Antrian Online</a></li>
                                @endif
                                @if($menuPublicBerita)
                                    <li><a href="{{ route('public.berita.index') }}" class="hover:text-brand-blue-400 transition-colors">Berita Desa</a></li>
                                @endif
                                @if($menuPublicSurat)
                                    <li><a href="{{ route('public.surat.create') }}" class="hover:text-brand-blue-400 transition-colors">Layanan Surat</a></li>
                                @endif
                                @if($menuPublicGaleri)
                                    <li><a href="{{ route('public.galeri.index') }}" class="hover:text-brand-blue-400 transition-colors">Galeri</a></li>
                                @endif
                                <li><a href="{{ route('public.transparansi.index') }}" class="hover:text-brand-blue-400 transition-colors">Transparansi Informasi</a></li>
                                <li><a href="{{ route('public.apbdes.index') }}" class="hover:text-brand-blue-400 transition-colors">APBDes Desa</a></li>
                                <li><a href="{{ route('public.realisasi.index') }}" class="hover:text-brand-blue-400 transition-colors">Realisasi Anggaran</a></li>
                                <li><a href="{{ route('public.pembangunan.index') }}" class="hover:text-brand-blue-400 transition-colors">Laporan Pembangunan</a></li>
                            @endif
                        </ul>
                    </div>

                    @if(!$isSystemLocked)
                    <div>
                        <h4 class="text-white font-bold mb-6">Informasi Kontak</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-brand-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>Jl. Poros Desa No.1, Kec. Rambah Samo, Riau</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-brand-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>+62 812-3456-7890</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-brand-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>admin@desarambahsamobarat.id</span>
                            </li>
                        </ul>
                    </div>
                    @endif

                    <div class="space-y-6">
                        <div>
                            <h4 class="text-white font-bold mb-4 text-sm">Peta Lokasi Desa</h4>
                            <div class="relative w-full h-32 rounded-2xl overflow-hidden border border-slate-800 shadow-inner group">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31918.423985785866!2d100.3134375!3d0.8550625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302a6aa26c59cdcf%3A0x8bb11fd67f5b4de3!2sRambah%20Samo%20Barat%2C%20Kec.%20Rambah%20Samo%2C%20Kabupaten%20Rokan%20Hulu%2C%20Riau!5e0!3m2!1sid!2sid!4v1716172600000!5m2!1sid!2sid" 
                                    class="absolute inset-0 w-full h-full border-0 grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-white font-bold mb-3 text-xs uppercase tracking-wider text-slate-400">Media Sosial</h4>
                            <div class="flex gap-3">
                                <a href="#" class="w-10 h-10 bg-slate-800 rounded-xl hover:bg-brand-blue-600 hover:scale-105 active:scale-95 transition-all text-white flex items-center justify-center font-bold text-sm shadow-md">FB</a>
                                <a href="#" class="w-10 h-10 bg-slate-800 rounded-xl hover:bg-brand-blue-600 hover:scale-105 active:scale-95 transition-all text-white flex items-center justify-center font-bold text-sm shadow-md">IG</a>
                                <a href="#" class="w-10 h-10 bg-slate-800 rounded-xl hover:bg-brand-blue-600 hover:scale-105 active:scale-95 transition-all text-white flex items-center justify-center font-bold text-sm shadow-md">YT</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center text-xs text-slate-500">
                    <p>{{ $copyrightText }}</p>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
            delay: 50,
        });
    </script>
</body>
</html>
