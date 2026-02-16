@extends('layouts.admin')

@section('title', 'Dashboard Antrian')
@section('page_title', 'Manajemen Antrian Online')

@section('content')
<div class="space-y-8">
    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="card p-6 border-l-4 border-brand-blue-500">
            <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Total Hari Ini</h4>
            <div class="text-3xl font-black text-slate-900">{{ $stats['total_today'] }}</div>
        </div>
        <div class="card p-6 border-l-4 border-amber-500">
            <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Menunggu</h4>
            <div class="text-3xl font-black text-slate-900">{{ $stats['waiting'] }}</div>
        </div>
        <div class="card p-6 md:col-span-2 bg-slate-900 text-white relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-brand-blue-500/10 rounded-full blur-2xl"></div>
            <div class="relative z-10 flex justify-between items-center h-full">
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-1">Sedang Dilayani</h4>
                    <div class="text-4xl font-mono font-black text-brand-blue-400 uppercase">
                        {{ $stats['current'] ? $stats['current']->nomor_antrian : '--' }}
                    </div>
                    @if($stats['current'])
                        <div class="text-[10px] text-white/60 font-medium mt-1 uppercase tracking-tight">
                            {{ $stats['current']->nama_pengunjung }} | Sesi {{ $stats['current']->jam_kunjungan }}
                        </div>
                    @endif
                </div>
                <div class="flex gap-2">
                    @can('antrian.manage')
                        @if($stats['current'])
                        <form action="{{ route('antrian.complete', $stats['current']->id) }}" method="POST">
                            @csrf
                            <button type="submit" title="Selesaikan Layanan" class="bg-emerald-500 hover:bg-emerald-600 text-white p-3 rounded-xl shadow-lg shadow-emerald-500/20 transition-all">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('antrian.call-next') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-brand-blue-600 hover:bg-brand-blue-700 text-white px-6 py-3 rounded-xl shadow-lg shadow-brand-blue-500/20 flex items-center gap-2 font-black uppercase tracking-widest text-xs transition-all hover:-translate-y-1">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path></svg>
                                Panggil Berikutnya
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & List -->
    <div class="flex flex-col gap-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h3 class="text-sm font-black uppercase tracking-widest text-slate-800 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-brand-blue-500"></span>
                Daftar Antrian Online
            </h3>
            
            <form action="{{ route('antrian.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <input type="date" name="tanggal" value="{{ $uiFilters['tanggal'] ?? '' }}" onchange="this.form.submit()" class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold focus:ring-brand-blue-500 focus:border-brand-blue-500">
                
                <select name="status" onchange="this.form.submit()" class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold focus:ring-brand-blue-500">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ ($filters['status'] ?? '') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="dipanggil" {{ ($filters['status'] ?? '') == 'dipanggil' ? 'selected' : '' }}>Dipanggil</option>
                    <option value="selesai" {{ ($filters['status'] ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ ($filters['status'] ?? '') == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>

                <div class="relative min-w-[200px]">
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Cari pengunjung..." class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:ring-brand-blue-500">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-3 card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">Nomor</th>
                                <th class="px-6 py-4">Pengunjung</th>
                                <th class="px-6 py-4">Keperluan</th>
                                <th class="px-6 py-4">Waktu</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @if($items->count() > 0)
                                @foreach($items as $item)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-black text-brand-blue-600 font-mono">{{ $item->nomor_antrian }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-slate-800">{{ $item->nama_pengunjung }}</div>
                                            <div class="flex flex-col gap-1 mt-1">
                                                @if($item->nik_pengunjung)
                                                <div class="text-[9px] text-slate-400 font-mono">NIK: {{ $item->nik_pengunjung }}</div>
                                                @endif
                                                @if($item->kontak_pengunjung)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->kontak_pengunjung) }}" target="_blank" class="text-[10px] text-emerald-600 font-bold flex items-center gap-1 hover:underline">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                                    Whatsapp
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-slate-600 font-medium uppercase">{{ $item->keperluan }}</td>
                                        <td class="px-6 py-4">
                                            <div class="text-[10px] font-black text-slate-900 mb-0.5">{{ $item->jam_kunjungan }}</div>
                                            <div class="text-[9px] text-slate-400 font-medium">{{ $item->tanggal_kunjungan->format('d M Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusClasses = [
                                                    'menunggu' => 'bg-amber-50 text-amber-700 border-amber-100',
                                                    'dipanggil' => 'bg-brand-blue-50 text-brand-blue-700 border-brand-blue-100',
                                                    'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                    'batal' => 'bg-red-50 text-red-700 border-red-100',
                                                ];
                                            @endphp
                                            <span class="px-2 py-0.5 {{ $statusClasses[$item->status] ?? 'bg-slate-50 text-slate-600' }} border text-[9px] font-black uppercase rounded-lg">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end items-center gap-2">
                                                @can('antrian.manage')
                                                    @if($item->status == 'menunggu')
                                                        <form action="{{ route('antrian.cancel', $item->id) }}" method="POST" onsubmit="return confirm('Batalkan antrian ini?')">
                                                            @csrf
                                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="px-6 py-20 text-center">
                                        <div class="text-slate-300 mb-2">
                                            <svg class="w-10 h-10 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        </div>
                                        <p class="text-xs text-slate-400 italic">Tidak ada data antrian ditemukan.</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @if($items->hasPages())
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                        {{ $items->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6 lg:col-span-1">
                <!-- Info Card -->
                <div class="card p-6 bg-slate-50 border-slate-100">
                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Info Panggilan
                    </h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed mb-4">
                        Admin dapat memanggil antrian sesuai urutan atau memfilter berdasarkan tanggal untuk persiapan layanan esok hari.
                    </p>
                    <div class="p-3 bg-white rounded-xl border border-slate-100">
                        <div class="flex items-center gap-2 text-[10px] font-bold text-emerald-600 uppercase tracking-tight">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Sistem Siap
                        </div>
                    </div>
                </div>

                <!-- Call Control -->
                @can('antrian.manage')
                <div class="card p-6 bg-brand-blue-600 text-white shadow-xl shadow-brand-blue-200">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-brand-blue-200 mb-4">Panggilan Otomatis</h4>
                    <form action="{{ route('antrian.call-next') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-4 bg-white text-brand-blue-600 rounded-2xl font-black uppercase tracking-widest text-xs shadow-lg hover:-translate-y-1 transition-all active:scale-95">
                            Panggil Unit
                        </button>
                    </form>
                    <p class="text-[9px] text-brand-blue-200 mt-4 text-center leading-relaxed">
                        Gunakan speaker untuk output suara panggilan otomatis.
                    </p>
                </div>
                @endcan
            </div>
        </div>
        </div>

        {{-- Bersihkan Semua Antrian --}}
        @can('antrian.manage')
        @if($items->count() > 0)
        <div class="flex justify-end mt-4" x-data="{ showModal: false }">
            <button @click="showModal = true" type="button"
                class="text-xs font-bold text-red-500 hover:text-red-700 uppercase tracking-widest transition-colors flex items-center gap-2">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Bersihkan Semua Antrian
            </button>

            {{-- Modal Konfirmasi (Single) --}}
            <div x-show="showModal" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center p-4"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="fixed inset-0 bg-slate-900/60" @click="showModal = false"></div>
                <div class="relative bg-white rounded-xl shadow-2xl max-w-sm w-full p-6 z-10">
                    <div class="text-center mb-6">
                        <div class="mx-auto p-3 bg-red-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                            <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Bersihkan Semua Antrian?</h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                            Anda akan menghapus <span class="font-bold text-red-600">seluruh data antrian</span> dari database. Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button @click="showModal = false" type="button" class="flex-1 py-2.5 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors uppercase tracking-wider">
                            Batal
                        </button>
                        <form action="{{ route('antrian.clear-all') }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-2.5 text-xs font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors uppercase tracking-wider shadow-lg shadow-red-500/30">
                                Ya, Bersihkan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endcan
    </div>
</div>
@endsection
