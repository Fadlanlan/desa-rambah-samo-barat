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
</head>
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
                                    <img src="{{ asset($village->logo) }}" class="block h-10 w-auto">
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
                        <x-nav-link :href="route('public.berita.index')" :active="request()->routeIs('public.berita.*')">Berita</x-nav-link>
                        <x-nav-link :href="route('public.surat.create')" :active="request()->routeIs('public.surat.*')">Layanan Surat</x-nav-link>
                        <x-nav-link :href="route('public.antrian.create')" :active="request()->routeIs('public.antrian.*')">Antrian</x-nav-link>
                        <x-nav-link :href="route('public.galeri.index')" :active="request()->routeIs('public.galeri.*')">Galeri</x-nav-link>
                        <x-nav-link :href="route('public.pengaduan.create')" :active="request()->routeIs('public.pengaduan.*')">Pengaduan</x-nav-link>
                        
                        @guest
                            <a href="{{ route('login') }}" class="btn-primary">
                                Masuk Layanan
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn-secondary">
                                Dashboard
                            </a>
                        @endguest
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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
                    <x-responsive-nav-link :href="route('public.berita.index')" :active="request()->routeIs('public.berita.*')">Berita</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('public.surat.create')" :active="request()->routeIs('public.surat.*')">Layanan Surat</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('public.antrian.create')" :active="request()->routeIs('public.antrian.*')">Antrian</x-responsive-nav-link>
                    <x-responsive-nav-link :href="'#'">Galeri</x-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center btn-primary py-3">
                                Masuk Layanan
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12 border-b border-slate-800 pb-12">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                             @if($village->logo)
                                 <img src="{{ asset($village->logo) }}" class="block h-8 w-auto">
                             @else
                                 <x-application-logo class="block h-8 w-auto fill-current text-white" />
                             @endif
                             <span class="font-bold text-lg tracking-tight text-white uppercase">{{ $village->nama_desa ?? 'Samo Barat' }}</span>
                        </div>
                        <p class="text-sm leading-relaxed">
                            Official Website Desa {{ $village->nama_desa ?? 'Rambah Samo Barat' }}. <br>
                            Mewujudkan tata kelola desa yang transparan, akuntabel, dan inovatif.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="text-white font-bold mb-6">Tautan Cepat</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="{{ route('public.profil.index') }}" class="hover:text-brand-blue-400 transition-colors">Profil Desa</a></li>
                            <li><a href="{{ route('public.pengaduan.create') }}" class="hover:text-brand-blue-400 transition-colors">Layanan Pengaduan</a></li>
                            <li><a href="{{ route('public.antrian.create') }}" class="hover:text-brand-blue-400 transition-colors">Antrian Online</a></li>
                            <li><a href="{{ route('public.berita.index') }}" class="hover:text-brand-blue-400 transition-colors">Berita Desa</a></li>
                            <li><a href="#" class="hover:text-brand-blue-400 transition-colors">Transparansi Dana</a></li>
                        </ul>
                    </div>

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

                    <div>
                        <h4 class="text-white font-bold mb-6">Media Sosial</h4>
                        <div class="flex gap-4">
                            <!-- Social icons placeholder -->
                            <a href="#" class="p-2 bg-slate-800 rounded-lg hover:bg-brand-blue-600 transition-all text-white">FB</a>
                            <a href="#" class="p-2 bg-slate-800 rounded-lg hover:bg-brand-blue-600 transition-all text-white">IG</a>
                            <a href="#" class="p-2 bg-slate-800 rounded-lg hover:bg-brand-blue-600 transition-all text-white">YT</a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center text-xs text-slate-500">
                    <p>&copy; {{ date('Y') }} Desa {{ $village->nama_desa ?? 'Rambah Samo Barat' }}. Seluruh hak cipta dilindungi.</p>
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
