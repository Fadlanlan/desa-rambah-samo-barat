@extends('layouts.public')

@section('title', 'Anggaran Pendapatan & Belanja Desa - Desa Rambah Samo Barat')

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
                        <span class="ml-1 md:ml-2">APBDes</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8 text-left" data-aos="fade-right">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-brand-green-500/20 text-brand-green-300 border border-brand-green-500/30 mb-4 uppercase tracking-widest">
                    📄 Rincian APBDes Resmi
                </span>
                <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                    Anggaran Pendapatan &<br class="hidden sm:inline"> Belanja Desa (APBDes)
                </h1>
                <p class="text-brand-blue-100 max-w-2xl text-lg leading-relaxed">
                    Sistem publikasi postur APBDes resmi untuk rincian pendapatan asli, dana transfer, pembiayaan, hingga penyaluran belanja desa Rambah Samo Barat.
                </p>
            </div>
            
            <div class="lg:col-span-4 flex lg:justify-end" data-aos="fade-left">
                <!-- Year selector -->
                <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/20 shadow-xl w-full max-w-sm">
                    <h3 class="text-sm font-bold text-brand-blue-200 uppercase tracking-wider mb-3">Tahun Anggaran</h3>
                    <form action="" method="GET" class="flex gap-2">
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
<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Summary Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 -mt-20 relative z-20">
            <!-- Total Pendapatan Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <span class="text-[10px] font-black uppercase text-brand-blue-600 bg-brand-blue-50 px-2 py-1 rounded mb-3 inline-block">Pendapatan</span>
                    <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Pendapatan</h4>
                    <h3 class="text-2xl font-black text-slate-900 mb-4">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
                <div class="border-t border-slate-100 pt-3 text-[11px] text-slate-500 font-semibold flex justify-between">
                    <span>PADes: <strong class="text-slate-800">Rp {{ number_format($pad, 0, ',', '.') }}</strong></span>
                </div>
            </div>

            <!-- Total Belanja Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <span class="text-[10px] font-black uppercase text-emerald-600 bg-emerald-50 px-2 py-1 rounded mb-3 inline-block">Belanja</span>
                    <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Belanja</h4>
                    <h3 class="text-2xl font-black text-slate-900 mb-4">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</h3>
                </div>
                <div class="border-t border-slate-100 pt-3 text-[11px] text-slate-500 font-semibold flex justify-between">
                    <span>Dana Desa: <strong class="text-slate-800">Rp {{ number_format($danaDesa, 0, ',', '.') }}</strong></span>
                </div>
            </div>

            <!-- Bantuan Pemerintah Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="300">
                <div>
                    <span class="text-[10px] font-black uppercase text-purple-600 bg-purple-50 px-2 py-1 rounded mb-3 inline-block">Transfer</span>
                    <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Bantuan & Transfer</h4>
                    <h3 class="text-2xl font-black text-slate-900 mb-4">Rp {{ number_format($bantuanPemerintah, 0, ',', '.') }}</h3>
                </div>
                <div class="border-t border-slate-100 pt-3 text-[11px] text-slate-500 font-semibold flex justify-between">
                    <span>Bantuan Keuangan Provinsi & ADD</span>
                </div>
            </div>

            <!-- Sisa Anggaran Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="400">
                <div>
                    <span class="text-[10px] font-black uppercase {{ $sisaAnggaran >= 0 ? 'text-amber-600 bg-amber-50' : 'text-rose-600 bg-rose-50' }} px-2 py-1 rounded mb-3 inline-block">
                        {{ $sisaAnggaran >= 0 ? 'Surplus' : 'Defisit (Silpa)' }}
                    </span>
                    <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Selisih Surplus/Defisit</h4>
                    <h3 class="text-2xl font-black mb-4 {{ $sisaAnggaran >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                        Rp {{ number_format($sisaAnggaran, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="border-t border-slate-100 pt-3 text-[11px] text-slate-500 font-semibold flex justify-between">
                    <span>Tertutupi SiLPA Tahun Sebelumnya</span>
                </div>
            </div>
        </div>

        <!-- Detail Table Section -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 mb-12" data-aos="fade-up">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Rincian Pos Anggaran Keuangan</h3>
                    <p class="text-xs text-slate-500">Tabel penjabaran resmi seluruh akun neraca anggaran pendapatan, belanja, dan pembiayaan</p>
                </div>
                
                <!-- Search & Filters -->
                <form action="" method="GET" class="flex flex-wrap items-center gap-3">
                    <input type="hidden" name="year" value="{{ $selectedYear }}">
                    <div class="relative min-w-[200px]">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari uraian..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-xl focus:ring-brand-blue-500 focus:border-brand-blue-500 text-sm font-medium">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    
                    <select name="sort_by" class="rounded-xl border border-slate-200 py-2 pl-3 pr-8 focus:ring-brand-blue-500 focus:border-brand-blue-500 text-xs font-semibold text-slate-600 transition-all">
                        <option value="jenis" {{ $sortBy === 'jenis' ? 'selected' : '' }}>Urut Kategori</option>
                        <option value="anggaran" {{ $sortBy === 'anggaran' ? 'selected' : '' }}>Urut Nilai Anggaran</option>
                    </select>

                    <select name="sort_order" class="rounded-xl border border-slate-200 py-2 pl-3 pr-8 focus:ring-brand-blue-500 focus:border-brand-blue-500 text-xs font-semibold text-slate-600 transition-all">
                        <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>Menaik (A-Z)</option>
                        <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>Menurun (Z-A)</option>
                    </select>

                    <button type="submit" class="bg-brand-blue-600 hover:bg-brand-blue-700 text-white font-bold px-4 py-2 rounded-xl transition-all shadow-sm text-xs active:scale-95">
                        Terapkan
                    </button>
                    @if($search || $sortBy !== 'jenis' || $sortOrder !== 'asc')
                        <a href="{{ route('public.apbdes.index') }}" class="text-xs text-slate-400 hover:text-slate-600 font-bold transition-colors">Reset</a>
                    @endif
                </form>
            </div>

            <!-- Responsive Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-xs font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="py-4 px-4">Jenis</th>
                            <th class="py-4 px-4">Uraian Akun</th>
                            <th class="py-4 px-4 hidden md:table-cell">Sub Kategori / Bidang</th>
                            <th class="py-4 px-4">Anggaran</th>
                            <th class="py-4 px-4">Realisasi</th>
                            <th class="py-4 px-4 hidden sm:table-cell text-center">Progress</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($items as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 font-bold">
                                @if(strtolower($item->jenis) === 'pendapatan')
                                    <span class="px-2 py-0.5 rounded text-[10px] bg-blue-50 text-brand-blue-700 uppercase font-black">Pendapatan</span>
                                @elseif(strtolower($item->jenis) === 'belanja')
                                    <span class="px-2 py-0.5 rounded text-[10px] bg-emerald-50 text-emerald-700 uppercase font-black">Belanja</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] bg-purple-50 text-purple-700 uppercase font-black">Pembiayaan</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 font-black text-slate-800 leading-snug">
                                <span class="block">{{ $item->uraian }}</span>
                                <span class="text-[10px] text-slate-400 font-medium md:hidden block mt-0.5">{{ $item->kategori }} / {{ $item->sub_kategori }}</span>
                            </td>
                            <td class="py-4 px-4 text-slate-500 font-medium hidden md:table-cell">
                                <span class="block font-bold text-slate-700 text-xs">{{ $item->kategori }}</span>
                                <span class="text-[11px] text-slate-400">{{ $item->sub_kategori }}</span>
                            </td>
                            <td class="py-4 px-4 font-bold text-slate-900 whitespace-nowrap">
                                Rp {{ number_format($item->anggaran, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4 font-bold text-slate-500 whitespace-nowrap">
                                Rp {{ number_format($item->realisasi, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4 hidden sm:table-cell">
                                @php
                                    $pct = $item->anggaran > 0 ? round(($item->realisasi / $item->anggaran) * 100) : 0;
                                @endphp
                                <div class="flex items-center flex-col w-20 mx-auto">
                                    <span class="text-[10px] font-black text-slate-600 mb-1">{{ $pct }}%</span>
                                    <div class="w-full bg-slate-100 rounded-full h-1.5">
                                        <div class="h-1.5 rounded-full 
                                            @if($pct >= 100)
                                                bg-emerald-500
                                            @elseif($pct > 0)
                                                bg-amber-500
                                            @else
                                                bg-slate-300
                                            @endif" style="width: {{ min($pct, 100) }}%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400 font-medium">
                                Tidak ada rincian pos anggaran yang ditemukan untuk filter pencarian ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $items->links() }}
            </div>
        </div>

        <!-- Alpine.js Dynamic Gallery Block -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8" 
             x-data="{ activeImage: null, activeTitle: '' }" data-aos="fade-up">
            <div class="mb-8">
                <h3 class="text-lg font-bold text-slate-900">Dokumentasi Proyek Fisik & Kegiatan</h3>
                <p class="text-xs text-slate-500">Galeri foto realisasi di lapangan pembangunan desa Rambah Samo Barat</p>
            </div>

            <!-- Grid Gallery -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($gallery as $gal)
                <div class="group relative rounded-2xl overflow-hidden border border-slate-100 shadow-sm cursor-pointer hover:shadow-xl transition-all duration-300"
                     @click="activeImage = '{{ $gal->img }}'; activeTitle = '{{ $gal->title }}'">
                    <div class="aspect-video w-full overflow-hidden bg-slate-100">
                        <img src="{{ $gal->img }}" alt="{{ $gal->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent flex flex-col justify-end p-5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-[10px] font-black uppercase text-brand-green-400 mb-1">{{ $gal->kategori }}</span>
                        <h4 class="text-white font-bold leading-snug text-sm">{{ $gal->title }}</h4>
                        <span class="text-[11px] text-white/70 mt-2 font-medium flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Klik untuk perbesar
                        </span>
                    </div>
                    <div class="p-4 bg-white border-t border-slate-50 sm:group-hover:hidden transition-all">
                        <span class="text-[9px] font-black text-brand-blue-500 uppercase">{{ $gal->kategori }}</span>
                        <h4 class="text-slate-800 font-bold text-sm truncate">{{ $gal->title }}</h4>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Lightbox Modal (Murni Alpine.js) -->
            <div x-show="activeImage" 
                 class="fixed inset-0 z-50 bg-black/85 backdrop-blur-sm flex items-center justify-center p-4 transition-all"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @keydown.escape.window="activeImage = null"
                 style="display: none;">
                <div class="relative max-w-4xl w-full bg-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-white/10"
                     @click.away="activeImage = null">
                    <button class="absolute top-4 right-4 z-10 w-10 h-10 bg-black/60 rounded-full text-white hover:bg-black/90 flex items-center justify-center font-bold text-xl transition-all"
                            @click="activeImage = null">
                        &times;
                    </button>
                    <div class="aspect-video w-full bg-slate-950">
                        <img :src="activeImage" :alt="activeTitle" class="w-full h-full object-contain">
                    </div>
                    <div class="p-6 bg-slate-900 text-white border-t border-white/5">
                        <h4 class="font-extrabold text-lg" x-text="activeTitle"></h4>
                        <p class="text-slate-400 text-xs mt-1">Dokumentasi Lapangan Resmi Pemerintahan Desa Rambah Samo Barat TA 2026</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
