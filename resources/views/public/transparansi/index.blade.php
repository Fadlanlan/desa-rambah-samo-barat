@extends('layouts.public')

@section('title', 'Transparansi Informasi Desa - Desa Rambah Samo Barat')

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
                        <span class="ml-1 md:ml-2">Transparansi</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8 text-left" data-aos="fade-right">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-brand-green-500/20 text-brand-green-300 border border-brand-green-500/30 mb-4 uppercase tracking-widest">
                    <span class="w-2 h-2 rounded-full bg-brand-green-400 animate-pulse"></span>
                    Keterbukaan Informasi Publik
                </span>
                <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                    Transparansi Informasi Keuangan Desa
                </h1>
                <p class="text-brand-blue-100 max-w-2xl text-lg leading-relaxed">
                    Komitmen Pemerintah Desa Rambah Samo Barat dalam mewujudkan tata kelola keuangan yang akuntabel, partisipatif, terbuka, dan bertanggung jawab penuh demi kesejahteraan masyarakat.
                </p>
            </div>
            
            <div class="lg:col-span-4 flex lg:justify-end" data-aos="fade-left">
                <!-- Year Filter Card -->
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
        
        <!-- Summary Widgets Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 -mt-20 relative z-20">
            <!-- Pendapatan Widget -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 flex items-start gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="100">
                <div class="p-4 rounded-xl bg-blue-50 text-brand-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4c-4.42 0-8 3.58-8 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm1 13h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                    </svg>
                </div>
                <div class="flex-grow">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Pendapatan Desa</p>
                    <h3 class="text-2xl font-black text-slate-900 mb-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="font-bold text-slate-700">Realisasi:</span>
                        <span class="font-black text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Rp {{ number_format($totalPendapatanRealisasi, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Belanja Widget -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 flex items-start gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="200">
                <div class="p-4 rounded-xl bg-emerald-50 text-emerald-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="flex-grow">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Belanja Desa</p>
                    <h3 class="text-2xl font-black text-slate-900 mb-1">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</h3>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="font-bold text-slate-700">Realisasi:</span>
                        <span class="font-black text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">Rp {{ number_format($totalBelanjaRealisasi, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Realisasi Progress Widget -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 flex items-start gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="300">
                <div class="p-4 rounded-xl bg-amber-50 text-amber-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="flex-grow">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Kemajuan Penyerapan Belanja</p>
                    <div class="flex items-baseline gap-1 mb-1">
                        <h3 class="text-3xl font-black text-slate-900">{{ $realizationProgress }}%</h3>
                        <span class="text-xs font-bold text-slate-400">selesai</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-amber-500 h-2 rounded-full transition-all duration-1000" style="width: {{ min($realizationProgress, 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
            <!-- Allocation Charts Card -->
            <div class="lg:col-span-7 bg-white rounded-3xl shadow-sm border border-slate-100 p-8" data-aos="fade-right">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-3 pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Alokasi Anggaran Belanja</h3>
                        <p class="text-xs text-slate-500">Sebaran alokasi dana per bidang kerja desa</p>
                    </div>
                    <div class="flex gap-2">
                        <span class="inline-flex items-center gap-1.5 text-xs text-slate-500 font-medium">
                            <span class="w-2.5 h-2.5 rounded-full bg-brand-blue-500"></span>
                            Anggaran
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-xs text-slate-500 font-medium">
                            <span class="w-2.5 h-2.5 rounded-full bg-brand-green-500"></span>
                            Realisasi
                        </span>
                    </div>
                </div>
                
                <!-- Chart.js Container -->
                <div class="relative w-full h-80 sm:h-96">
                    <canvas id="transparansiPieChart"></canvas>
                </div>
            </div>

            <!-- Active Program and Progress Bar -->
            <div class="lg:col-span-5 bg-white rounded-3xl shadow-sm border border-slate-100 p-8 flex flex-col justify-between" data-aos="fade-left">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Program Unggulan Terpadu</h3>
                    <p class="text-xs text-slate-500 mb-6">Kemajuan program kerja utama Pemerintah Desa</p>
                    
                    <div class="space-y-5">
                        @foreach($programs->take(4) as $prog)
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-bold text-slate-800 line-clamp-1 flex-grow pr-3">{{ $prog['nama'] }}</span>
                                <span class="text-xs font-black text-brand-blue-600 bg-brand-blue-50 px-2 py-0.5 rounded">{{ $prog['progress'] }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 mb-1.5">
                                <div class="bg-brand-blue-500 h-1.5 rounded-full transition-all duration-1000" style="width: {{ $prog['progress'] }}%"></div>
                            </div>
                            <div class="flex items-center justify-between text-[11px] text-slate-500">
                                <span class="flex items-center gap-1">
                                    @if($prog['status'] === 'Selesai')
                                        <span class="text-emerald-600 font-bold">✓ {{ $prog['status'] }}</span>
                                    @elseif($prog['status'] === 'Berjalan')
                                        <span class="text-amber-600 font-bold">➜ {{ $prog['status'] }}</span>
                                    @else
                                        <span class="text-slate-400 font-semibold">⚙ {{ $prog['status'] }}</span>
                                    @endif
                                </span>
                                <span>Realisasi: <strong class="text-slate-700">Rp {{ number_format($prog['dana'], 0, ',', '.') }}</strong></span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="pt-6 border-t border-slate-100 mt-6 flex justify-end">
                    <a href="{{ route('public.pembangunan.index') }}" class="text-sm font-bold text-brand-blue-600 hover:text-brand-blue-700 flex items-center gap-1 transition-colors">
                        Lihat Semua Pembangunan
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Documents Table Section -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 mb-12" data-aos="fade-up">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Dokumen Transparansi Publik</h3>
                    <p class="text-xs text-slate-500">Dapatkan salinan berkas resmi keuangan dan laporan pembangunan desa</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold text-slate-400">Total: {{ $documents->count() }} Berkas</span>
                </div>
            </div>

            <!-- Documents Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-xs font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="py-4 px-4">Nama Dokumen</th>
                            <th class="py-4 px-4 hidden sm:table-cell">Deskripsi</th>
                            <th class="py-4 px-4">Tanggal Unggah</th>
                            <th class="py-4 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach($documents as $doc)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="py-4 px-4 font-bold text-slate-800">
                                <div class="flex items-center gap-3">
                                    <div class="p-2.5 rounded-xl bg-rose-50 text-rose-600 transition-colors group-hover:bg-rose-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="block line-clamp-1 leading-snug">{{ $doc->nama }}</span>
                                        <span class="text-[10px] text-slate-400 font-medium sm:hidden block mt-0.5">{{ $doc->keterangan }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-slate-500 hidden sm:table-cell font-medium">{{ $doc->keterangan }}</td>
                            <td class="py-4 px-4 text-slate-500 font-bold text-xs">
                                {{ \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y') }}
                            </td>
                            <td class="py-4 px-4 text-right">
                                @if($doc->file_path && $doc->file_path !== '#')
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" download class="inline-flex items-center gap-1 bg-brand-blue-50 hover:bg-brand-blue-600 hover:text-white text-brand-blue-700 font-black px-4 py-2 rounded-xl transition-all shadow-sm text-xs" target="_blank">
                                        Unduh PDF
                                    </a>
                                @else
                                    <button class="inline-flex items-center gap-1 bg-slate-100 text-slate-400 font-semibold px-4 py-2 rounded-xl text-xs cursor-not-allowed" disabled>
                                        Tidak Tersedia
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Vertical Dynamic Timeline Section -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8" data-aos="fade-up">
            <div class="mb-10 text-center sm:text-left">
                <h3 class="text-lg font-bold text-slate-900">Agenda Realisasi & Rencana Pembangunan</h3>
                <p class="text-xs text-slate-500">Timeline program kerja fisik dan non-fisik terpenting desa</p>
            </div>

            <!-- Timeline -->
            <div class="relative border-l border-slate-200 ml-4 md:ml-6 space-y-10 pb-6">
                @foreach($programs as $index => $prog)
                <div class="relative pl-8 sm:pl-10 group">
                    <!-- Dot -->
                    <div class="absolute -left-[11px] top-1.5 w-6 h-6 rounded-full border-4 border-white flex items-center justify-center transition-all group-hover:scale-110 shadow
                        @if($prog['status'] === 'Selesai')
                            bg-emerald-500 text-white
                        @elseif($prog['status'] === 'Berjalan')
                            bg-amber-500 text-white
                        @else
                            bg-slate-300 text-slate-500
                        @endif">
                    </div>
                    
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 shadow-sm transition-all duration-300 hover:bg-white hover:shadow-xl hover:border-slate-200">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black tracking-wide uppercase
                                    @if($prog['status'] === 'Selesai')
                                        bg-emerald-50 text-emerald-700 border border-emerald-200
                                    @elseif($prog['status'] === 'Berjalan')
                                        bg-amber-50 text-amber-700 border border-amber-200
                                    @else
                                        bg-slate-200/50 text-slate-600 border border-slate-300
                                    @endif">
                                    {{ $prog['status'] }}
                                </span>
                                <span class="text-xs font-bold text-slate-400">Tahun Anggaran {{ $prog['tahun'] }}</span>
                            </div>
                            <span class="text-sm font-black text-slate-800">
                                Anggaran: <span class="text-brand-blue-600">Rp {{ number_format($prog['anggaran'], 0, ',', '.') }}</span>
                            </span>
                        </div>
                        
                        <h4 class="text-base font-bold text-slate-900 mb-2 leading-snug">{{ $prog['nama'] }}</h4>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium mb-4">{{ $prog['deskripsi'] }}</p>
                        
                        <div class="w-full bg-slate-200 rounded-full h-1.5 mb-1.5">
                            <div class="h-1.5 rounded-full transition-all duration-1000
                                @if($prog['status'] === 'Selesai')
                                    bg-emerald-500
                                @elseif($prog['status'] === 'Berjalan')
                                    bg-amber-500
                                @else
                                    bg-slate-300
                                @endif" style="width: {{ $prog['progress'] }}%"></div>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-slate-500">Realisasi: <strong class="text-slate-800">Rp {{ number_format($prog['dana'], 0, ',', '.') }}</strong></span>
                            <span class="font-bold text-slate-600">Progres Fisik: {{ $prog['progress'] }}%</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<!-- Chart.js Setup Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const primaryColorStr = getComputedStyle(document.documentElement).getPropertyValue('--color-brand-blue-500').trim() || '12, 137, 235';
        const secondaryColorStr = getComputedStyle(document.documentElement).getPropertyValue('--color-brand-green-500').trim() || '54, 183, 53';
        
        const categories = {!! json_encode(array_keys($categories)) !!};
        const budgets = {!! json_encode(array_values($categories)) !!};
        const realizations = {!! json_encode(array_values($realizationData)) !!};

        const ctx = document.getElementById('transparansiPieChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [
                    {
                        label: 'Anggaran Murni (Rp)',
                        data: budgets,
                        backgroundColor: `rgba(${primaryColorStr}, 0.85)`,
                        borderColor: `rgb(${primaryColorStr})`,
                        borderWidth: 1.5,
                        borderRadius: 8,
                        barPercentage: 0.6,
                    },
                    {
                        label: 'Realisasi Berjalan (Rp)',
                        data: realizations,
                        backgroundColor: `rgba(${secondaryColorStr}, 0.85)`,
                        borderColor: `rgb(${secondaryColorStr})`,
                        borderWidth: 1.5,
                        borderRadius: 8,
                        barPercentage: 0.6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        },
                        padding: 12,
                        cornerRadius: 12,
                        titleFont: { size: 13, weight: 'bold', family: 'Inter' },
                        bodyFont: { size: 12, family: 'Inter' }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { family: 'Inter', size: 11, weight: '600' },
                            color: '#64748b'
                        }
                    },
                    y: {
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            font: { family: 'Inter', size: 11 },
                            color: '#64748b',
                            callback: function (value) {
                                return 'Rp ' + (value / 1e6) + ' Jt';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
