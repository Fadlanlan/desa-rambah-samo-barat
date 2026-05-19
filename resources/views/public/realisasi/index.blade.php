@extends('layouts.public')

@section('title', 'Realisasi Anggaran Desa - Desa Rambah Samo Barat')

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
                        <span class="ml-1 md:ml-2">Realisasi Anggaran</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8 text-left" data-aos="fade-right">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-brand-green-500/20 text-brand-green-300 border border-brand-green-500/30 mb-4 uppercase tracking-widest">
                    📈 Grafik & Analisis
                </span>
                <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                    Realisasi Anggaran &<br class="hidden sm:inline"> Laporan Keuangan Berkala
                </h1>
                <p class="text-brand-blue-100 max-w-2xl text-lg leading-relaxed">
                    Sajian data visual analitik kas masuk, serapan belanja, dan keseimbangan anggaran untuk mengontrol transparansi anggaran per bulan desa Rambah Samo Barat.
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 -mt-20 relative z-20">
            <!-- Pendapatan Widget -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 flex items-start gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="100">
                <div class="p-4 rounded-xl bg-blue-50 text-brand-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div class="flex-grow">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Realisasi Pendapatan</p>
                    <h3 class="text-2xl font-black text-slate-900 mb-1">{{ $pendapatanProgress }}%</h3>
                    <div class="w-full bg-slate-100 rounded-full h-2 mb-2">
                        <div class="bg-brand-blue-500 h-2 rounded-full transition-all duration-1000" style="width: {{ min($pendapatanProgress, 100) }}%"></div>
                    </div>
                    <span class="text-xs font-bold text-slate-400">Rp {{ number_format($totalPendapatanRealisasi, 0, ',', '.') }} / Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
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
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Realisasi Belanja</p>
                    <h3 class="text-2xl font-black text-slate-900 mb-1">{{ $realizationProgress }}%</h3>
                    <div class="w-full bg-slate-100 rounded-full h-2 mb-2">
                        <div class="bg-emerald-500 h-2 rounded-full transition-all duration-1000" style="width: {{ min($realizationProgress, 100) }}%"></div>
                    </div>
                    <span class="text-xs font-bold text-slate-400">Rp {{ number_format($totalBelanjaRealisasi, 0, ',', '.') }} / Rp {{ number_format($totalBelanja, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Pembiayaan Widget -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 flex items-start gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="300">
                <div class="p-4 rounded-xl bg-purple-50 text-purple-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2m0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2"></path>
                    </svg>
                </div>
                <div class="flex-grow">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Realisasi Pembiayaan</p>
                    <h3 class="text-2xl font-black text-slate-900 mb-1">{{ $pembiayaanProgress }}%</h3>
                    <div class="w-full bg-slate-100 rounded-full h-2 mb-2">
                        <div class="bg-purple-500 h-2 rounded-full transition-all duration-1000" style="width: {{ min($pembiayaanProgress, 100) }}%"></div>
                    </div>
                    <span class="text-xs font-bold text-slate-400">Rp {{ number_format($totalPembiayaanRealisasi, 0, ',', '.') }} / Rp {{ number_format($totalPembiayaan, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Monthly Realization Chart Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 mb-12" data-aos="fade-up">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100 mb-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Arus Kas Bulanan (Realisasi Berjalan)</h3>
                    <p class="text-xs text-slate-500">Perbandingan pergerakan rencana pengeluaran bulanan vs realisasi dana terserap</p>
                </div>
                <div class="flex gap-2">
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-500 font-semibold">
                        <span class="w-3 h-3 rounded bg-brand-blue-500"></span>
                        Anggaran Bulanan
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-500 font-semibold">
                        <span class="w-3 h-3 rounded bg-brand-green-500"></span>
                        Realisasi Bulanan
                    </span>
                </div>
            </div>
            
            <div class="relative w-full h-96">
                <canvas id="monthlyRealisasiChart"></canvas>
            </div>
        </div>

        <!-- Field Realization Progress Grid -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8" data-aos="fade-up">
            <div class="mb-8 pb-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Rincian Realisasi per Bidang Kerja Desa</h3>
                <p class="text-xs text-slate-500">Persentase serapan belanja di lapangan per sektor pemerintahan dan sosial kemasyarakatan</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($categoriesData as $bidang)
                @php
                    $bidangProgress = $bidang->total_anggaran > 0 ? round(($bidang->total_realisasi / $bidang->total_anggaran) * 100, 1) : 0;
                    $sisaAnggaranBidang = $bidang->total_anggaran - $bidang->total_realisasi;
                @endphp
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 shadow-sm transition-all hover:bg-white hover:shadow-xl hover:border-slate-200">
                    <div class="flex items-start justify-between mb-3 gap-2">
                        <h4 class="text-sm font-extrabold text-slate-800 leading-snug line-clamp-2 max-w-[80%]">
                            {{ $bidang->kategori }}
                        </h4>
                        <span class="text-sm font-black text-brand-blue-600 bg-brand-blue-50 px-2.5 py-0.5 rounded">
                            {{ $bidangProgress }}%
                        </span>
                    </div>

                    <div class="w-full bg-slate-200 rounded-full h-2 mb-4">
                        <div class="h-2 rounded-full transition-all duration-1000
                            @if($bidangProgress >= 100)
                                bg-emerald-500
                            @elseif($bidangProgress >= 50)
                                bg-brand-blue-500
                            @elseif($bidangProgress > 0)
                                bg-amber-500
                            @else
                                bg-slate-300
                            @endif" style="width: {{ min($bidangProgress, 100) }}%"></div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 text-xs">
                        <div>
                            <span class="block text-slate-400 font-semibold mb-0.5">Anggaran</span>
                            <span class="font-extrabold text-slate-800">Rp {{ number_format($bidang->total_anggaran, 0, ',', '.') }}</span>
                        </div>
                        <div>
                            <span class="block text-slate-400 font-semibold mb-0.5">Realisasi</span>
                            <span class="font-extrabold text-emerald-600">Rp {{ number_format($bidang->total_realisasi, 0, ',', '.') }}</span>
                        </div>
                        <div class="text-right">
                            <span class="block text-slate-400 font-semibold mb-0.5">Sisa</span>
                            <span class="font-extrabold text-slate-800">Rp {{ number_format($sisaAnggaranBidang, 0, ',', '.') }}</span>
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
        
        const monthlyData = {!! json_encode($monthlyRealisasi) !!};
        const months = Object.keys(monthlyData);
        const budgets = months.map(m => monthlyData[m].anggaran);
        const realizations = months.map(m => monthlyData[m].realisasi);

        const ctx = document.getElementById('monthlyRealisasiChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Anggaran Bulanan (Rp)',
                        data: budgets,
                        borderColor: `rgb(${primaryColorStr})`,
                        backgroundColor: `rgba(${primaryColorStr}, 0.05)`,
                        borderWidth: 3,
                        pointBackgroundColor: `rgb(${primaryColorStr})`,
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        tension: 0.35,
                        fill: true,
                    },
                    {
                        label: 'Realisasi Terserap (Rp)',
                        data: realizations,
                        borderColor: `rgb(${secondaryColorStr})`,
                        backgroundColor: `rgba(${secondaryColorStr}, 0.05)`,
                        borderWidth: 3,
                        pointBackgroundColor: `rgb(${secondaryColorStr})`,
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        tension: 0.35,
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
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
                            color: '#f1f5f9'
                        },
                        ticks: {
                            font: { family: 'Inter', size: 12, weight: '600' },
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
