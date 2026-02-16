<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard - Desa Rambah Samo Barat')</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-900">
    <div x-data="{ sidebarOpen: false }" class="min-h-full">
        <!-- Sidebar for mobile -->
        <div x-show="sidebarOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/80"></div>

            <div class="fixed inset-0 flex">
                <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative mr-16 flex w-full max-w-xs flex-1">
                    <!-- Sidebar content -->
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-brand-blue-700 px-6 pb-4">
                        <div class="flex h-16 shrink-0 items-center">
                            <x-application-logo class="h-8 w-auto fill-current text-white" />
                            <span class="ml-3 text-white font-bold tracking-tight">ADMIN SID</span>
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                <li>
                                    <ul role="list" class="-mx-2 space-y-1">
                                        <li>
                                            <a href="{{ route('dashboard') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 bg-brand-blue-800 text-white">
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('warga.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('warga.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }}">
                                                Kependudukan
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('keluarga.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('keluarga.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }}">
                                                Keluarga
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('berita.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('berita.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }}">
                                                Berita & Konten
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('wisata.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('wisata.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }}">
                                                Wisata Desa
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('surat.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('surat.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }}">
                                                Permohonan Surat
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('jenis-surat.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('jenis-surat.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }}">
                                                Jenis Surat
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('pengaduan.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('pengaduan.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }}">
                                                Aduan Warga
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('antrian.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('antrian.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }}">
                                                Antrian Online
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('audit.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('audit.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }}">
                                                Audit Log
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-brand-blue-900 px-6 pb-4 border-r border-slate-800">
                <div class="flex h-16 shrink-0 items-center border-b border-brand-blue-800">
                    <x-application-logo class="h-8 w-auto fill-current text-brand-green-400" />
                    <span class="ml-3 text-white font-bold tracking-tight text-lg uppercase">Samo Barat</span>
                </div>
                <nav class="flex flex-1 flex-col mt-4">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-2">
                                @if(auth()->user()->hasRole('super-admin'))
                                    <li>
                                        <span class="text-xs font-semibold leading-6 text-brand-blue-400 uppercase tracking-widest pl-2 mt-4 inline-block">Super Admin</span>
                                        <a href="{{ route('superadmin.dashboard') }}" class="{{ request()->routeIs('superadmin.dashboard') ? 'bg-indigo-600 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all mt-1">
                                            Super Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('superadmin.user.index') }}" class="{{ request()->routeIs('superadmin.user.*') ? 'bg-indigo-600 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                            Manajemen User
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('superadmin.system') }}" class="{{ request()->routeIs('superadmin.system') ? 'bg-indigo-600 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                            Sistem & Log
                                        </a>
                                    </li>
                                    <li class="border-b border-brand-blue-800 my-4"></li>
                                @endif

                                <li>
                                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        Admin Dashboard
                                    </a>
                                </li>
                                <li>
                                    <span class="text-xs font-semibold leading-6 text-brand-blue-400 uppercase tracking-widest pl-2 mt-4 inline-block">Manajemen</span>
                                    <a href="{{ route('warga.index') }}" class="{{ request()->routeIs('warga.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all mt-1">
                                        Kependudukan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('keluarga.index') }}" class="{{ request()->routeIs('keluarga.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        Keluarga
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('berita.index') }}" class="{{ request()->routeIs('berita.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        Berita & Konten
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('surat.index') }}" class="{{ request()->routeIs('surat.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        Permohonan Surat
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('jenis-surat.index') }}" class="{{ request()->routeIs('jenis-surat.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        Jenis Surat
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('pengaduan.index') }}" class="{{ request()->routeIs('pengaduan.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all mt-1">
                                        Aduan Warga
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('antrian.index') }}" class="{{ request()->routeIs('antrian.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all mt-1">
                                        Antrian Online
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('audit.index') }}" class="{{ request()->routeIs('audit.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all mt-1">
                                        Audit Log
                                    </a>
                                </li>

                                <li>
                                    <span class="text-xs font-semibold leading-6 text-brand-blue-400 uppercase tracking-widest pl-2 mt-4 inline-block">Website & Informasi</span>
                                    <a href="{{ route('pengumuman.index') }}" class="{{ request()->routeIs('pengumuman.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all mt-1">
                                        Pengumuman
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('agenda.index') }}" class="{{ request()->routeIs('agenda.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        Agenda
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('galeri.index') }}" class="{{ request()->routeIs('galeri.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        Galeri Foto
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dokumen.index') }}" class="{{ request()->routeIs('dokumen.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        Dokumen Publik
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('wisata.index') }}" class="{{ request()->routeIs('wisata.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        Wisata Desa
                                    </a>
                                </li>

                                <li>
                                    <span class="text-xs font-semibold leading-6 text-brand-blue-400 uppercase tracking-widest pl-2 mt-4 inline-block">Data Desa</span>
                                    <a href="{{ route('apbdes.index') }}" class="{{ request()->routeIs('apbdes.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all mt-1">
                                        APBDes
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('umkm.index') }}" class="{{ request()->routeIs('umkm.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        UMKM
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('kontak.index') }}" class="{{ request()->routeIs('kontak.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                        Pesan Masuk
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="mt-auto">
                            <a href="{{ route('pengaturan.index') }}" class="{{ request()->routeIs('pengaturan.*') ? 'bg-brand-blue-800 text-white' : 'text-brand-blue-200 hover:text-white hover:bg-brand-blue-800' }} group -mx-2 flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all">
                                Pengaturan
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-slate-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <button @click="sidebarOpen = true" type="button" class="-m-2.5 p-2.5 text-slate-700 lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                </button>

                <!-- Separator -->
                <div class="h-6 w-px bg-slate-200 lg:hidden" aria-hidden="true"></div>

                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6 items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-800 uppercase tracking-tight">@yield('page_title', 'Dashboard')</h2>
                    
                    <!-- Global Search -->
                    <div class="flex-1 max-w-md px-4" x-data="{ 
                        searchQuery: '', 
                        searchResults: [], 
                        isSearching: false,
                        showResults: false,
                        async performSearch() {
                            if (this.searchQuery.length < 2) {
                                this.searchResults = [];
                                this.showResults = false;
                                return;
                            }
                            this.isSearching = true;
                            try {
                                const response = await fetch(`{{ route(auth()->user()->hasRole('super-admin') ? 'superadmin.search' : 'admin.search') }}?q=${encodeURIComponent(this.searchQuery)}`);
                                this.searchResults = await response.json();
                                this.showResults = true;
                            } catch (e) {
                                console.error('Search failed', e);
                            } finally {
                                this.isSearching = false;
                            }
                        }
                    }">
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" /></svg>
                            </div>
                            <input type="text" 
                                x-model="searchQuery" 
                                @input.debounce.300ms="performSearch()"
                                @keydown.escape="showResults = false"
                                @click.away="showResults = false"
                                class="block w-full rounded-full border-0 py-1.5 pl-10 pr-3 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6 bg-slate-50" 
                                placeholder="Cari data, fitur, atau warga...">
                            
                            <!-- Search Results Dropdown -->
                            <div x-show="showResults" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                class="absolute left-0 mt-2 w-full max-h-96 overflow-y-auto rounded-xl bg-white p-2 shadow-2xl ring-1 ring-black ring-opacity-5 z-50">
                                
                                <template x-if="searchResults.length === 0">
                                    <div class="px-4 py-8 text-center">
                                        <p class="text-sm text-slate-500">Tidak ada hasil ditemukan.</p>
                                    </div>
                                </template>

                                <div class="space-y-1">
                                    <template x-for="item in searchResults" :key="item.url">
                                        <a :href="item.url" class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-all">
                                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <p class="font-semibold text-slate-900" x-text="item.title"></p>
                                                    <span class="text-[10px] uppercase tracking-wider font-bold text-slate-400 bg-slate-50 px-1.5 py-0.5 rounded" x-text="item.category"></span>
                                                </div>
                                            </div>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <!-- Notifications -->
                        <button type="button" class="-m-2.5 p-2.5 text-slate-400 hover:text-slate-500">
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                        </button>

                        <!-- Profile dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button">
                                <span class="sr-only">Open user menu</span>
                                <div class="h-8 w-8 rounded-full bg-brand-blue-100 flex items-center justify-center text-brand-blue-700 font-bold border border-brand-blue-200">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden lg:flex lg:items-center">
                                    <span class="ml-4 text-sm font-semibold leading-6 text-slate-900" aria-hidden="true">{{ Auth::user()->name }}</span>
                                    <svg class="ml-2 h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                                </span>
                            </button>

                            <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-slate-900/5 focus:outline-none">
                                <a href="{{ route('profile.edit') }}" class="block px-3 py-1 text-sm leading-6 text-slate-900 hover:bg-slate-50">Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-3 py-1 text-sm leading-6 text-slate-900 hover:bg-slate-50">Keluar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3">
                            <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800 flex items-center gap-3">
                            <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-sm font-medium">{{ session('error') }}</span>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
