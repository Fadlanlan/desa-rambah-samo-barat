@extends('layouts.admin')

@section('title', 'Dashboard Admin - Desa Rambah Samo Barat')
@section('page_title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat Card 1 -->
        <div class="card p-6 border-l-4 border-brand-blue-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Penduduk</p>
                    <p class="text-3xl font-black text-slate-900 mt-1">{{ number_format($stats['total_penduduk']) }}</p>
                </div>
                <div class="p-3 bg-brand-blue-50 rounded-lg text-brand-blue-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-[10px] font-bold uppercase tracking-wider">
                <span class="text-emerald-600">{{ $stats['penduduk_aktif'] }} Aktif</span>
                <span class="text-slate-400 ml-2">Warga Desa</span>
            </div>
        </div>

        <!-- Stat Card 2 (Surat Waiting) -->
        <div class="card p-6 border-l-4 border-amber-500 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Menunggu Persetujuan</p>
                    <p class="text-3xl font-black text-slate-900 mt-1">{{ number_format($suratStats['menunggu']) }}</p>
                </div>
                <div class="p-3 bg-amber-50 rounded-lg text-amber-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-[10px] font-bold uppercase tracking-wider text-amber-600">
                Perlu Tindakan
            </div>
        </div>

        <!-- Stat Card 3 (Surat Processed) -->
        <div class="card p-6 border-l-4 border-brand-blue-400 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Sedang Diproses</p>
                    <p class="text-3xl font-black text-slate-900 mt-1">{{ number_format($suratStats['diproses']) }}</p>
                </div>
                <div class="p-3 bg-brand-blue-50 rounded-lg text-brand-blue-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-[10px] font-bold uppercase tracking-wider text-brand-blue-600">
                Dalam Antrian
            </div>
        </div>

        <!-- Stat Card 4 (Surat Finished) -->
        <div class="card p-6 border-l-4 border-emerald-500 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Selesai/Siap Ambil</p>
                    <p class="text-3xl font-black text-slate-900 mt-1">{{ number_format($suratStats['selesai']) }}</p>
                </div>
                <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-[10px] font-bold uppercase tracking-wider text-emerald-600">
                Surat Diterbitkan
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="card p-8">
            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest mb-6 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-brand-blue-600 rounded-full"></span>
                Demografi Jenis Kelamin
            </h3>
            <div class="h-64 flex items-center justify-center bg-slate-50 rounded-2xl relative overflow-hidden">
                <!-- Placeholder for Chart -->
                <div class="text-center z-10">
                    <div class="flex gap-8 justify-center mb-4">
                        <div class="text-center">
                            <span class="block text-3xl font-black text-brand-blue-600">{{ $genderStats['L'] ?? 0 }}</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Laki-laki</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-3xl font-black text-pink-500">{{ $genderStats['P'] ?? 0 }}</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Perempuan</span>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-0 flex items-end justify-center px-8 pb-4">
                    @php
                        $total = ($genderStats['L'] ?? 0) + ($genderStats['P'] ?? 0);
                        $lPercent = $total > 0 ? (($genderStats['L'] ?? 0) / $total) * 100 : 0;
                        $pPercent = $total > 0 ? (($genderStats['P'] ?? 0) / $total) * 100 : 0;
                    @endphp
                    <div class="w-full h-4 bg-slate-200 rounded-full flex overflow-hidden">
                        <div class="bg-brand-blue-600" style="width: {{ $lPercent }}%"></div>
                        <div class="bg-pink-500" style="width: {{ $pPercent }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-8">
            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest mb-6 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-brand-green-600 rounded-full"></span>
                Distribusi Kelompok Usia
            </h3>
            <div class="space-y-4">
                @foreach ($ageStats as $label => $count)
                @php
                    $total = array_sum($ageStats);
                    $percent = $total > 0 ? ($count / $total) * 100 : 0;
                    $colors = ['balita' => 'bg-emerald-400', 'anak' => 'bg-brand-blue-400', 'remaja' => 'bg-brand-green-500', 'dewasa' => 'bg-indigo-500', 'lansia' => 'bg-amber-500'];
                    $colorClass = $colors[$label] ?? 'bg-slate-400';
                @endphp
                <div class="space-y-1">
                    <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest text-slate-500">
                        <span>{{ ucfirst((string)$label) }}</span>
                        <span>{{ $count }} Jiwa ({{ round($percent) }}%)</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="{{ $colorClass }} h-full transition-all duration-1000" style="width: {{ $percent }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Data -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- New Recent Surat Column -->
        <div class="card overflow-hidden h-fit">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-bold text-slate-800 uppercase tracking-tight text-sm flex items-center gap-2">
                    <svg class="h-4 w-4 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Surat Terbaru
                </h3>
            </div>
            <div class="divide-y divide-slate-50">
                @if($recentSurat->count() > 0)
                    @foreach($recentSurat as $surat)
                    <div class="p-4 hover:bg-slate-50 transition-colors">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-xs font-bold text-slate-900">{{ $surat->penduduk->nama }}</p>
                            <span class="text-[8px] font-bold px-1.5 py-0.5 rounded uppercase
                                @if($surat->status == 'diajukan') bg-amber-100 text-amber-700
                                @elseif($surat->status == 'diproses') bg-brand-blue-100 text-brand-blue-700
                                @elseif($surat->status == 'selesai') bg-slate-700 text-white
                                @else bg-slate-100 text-slate-500 @endif
                            ">{{ $surat->status == 'diajukan' ? 'MENUNGGU' : $surat->status }}</span>
                        </div>
                        <p class="text-[10px] text-slate-500">{{ $surat->jenisSurat->name }}</p>
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-[9px] text-slate-400 font-mono italic">{{ $surat->created_at->diffForHumans() }}</span>
                            <a href="{{ route('surat.show', $surat->id) }}" class="text-[9px] font-bold text-brand-blue-600 uppercase hover:underline">PROSES</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="p-6 text-center text-[10px] text-slate-400 italic">Belum ada permohonan surat.</p>
                @endif
            </div>
        </div>

        <div class="lg:col-span-2 card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Update Penduduk Terbaru</h3>
                <a href="{{ route('warga.index') }}" class="text-[10px] font-black text-brand-blue-600 uppercase tracking-widest hover:text-brand-blue-700">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 text-right">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @if ($recentPenduduk->count() > 0)
                            @foreach ($recentPenduduk as $p)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-3">
                                    <p class="text-xs font-bold text-slate-900">{{ $p->nama }}</p>
                                    <p class="text-[10px] text-slate-400 font-mono">{{ $p->nik }}</p>
                                </td>
                                <td class="px-6 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-widest {{ $p->status == 'aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <a href="{{ route('warga.show', $p->id) }}" class="text-brand-blue-600 hover:text-brand-blue-800 transition-colors">
                                        <svg class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-slate-400 italic text-xs">Belum ada data terbaru</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                 <h3 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Artikel Terakhir</h3>
            </div>
            <div class="divide-y divide-slate-100">
                @if ($recentBerita->count() > 0)
                    @foreach ($recentBerita as $b)
                    <div class="p-4 hover:bg-slate-50 transition-colors flex gap-4">
                        @if ($b->gambar)
                        <img src="{{ asset('storage/' . $b->gambar) }}" class="h-10 w-14 object-cover rounded-lg border border-slate-100 shadow-sm" alt="">
                        @else
                        <div class="h-10 w-14 bg-slate-100 rounded-lg flex items-center justify-center text-slate-300">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        @endif
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-slate-900 truncate">{{ $b->judul }}</p>
                            <p class="text-[9px] text-slate-400 uppercase font-black mt-1">
                                {{ $b->published_at ? (\Carbon\Carbon::parse($b->published_at)->format('d M Y')) : 'DRAFT' }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="p-12 text-center text-slate-400 italic text-xs">Belum ada artikel</div>
                @endif
            </div>
            @if ($recentBerita->count() > 0)
            <div class="p-4 bg-slate-50 text-center">
                <a href="{{ route('berita.index') }}" class="text-[10px] font-black text-brand-blue-600 uppercase tracking-widest">Semua Artikel</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
