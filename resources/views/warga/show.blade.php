@extends('layouts.admin')

@section('title', 'Detail Penduduk - ' . $penduduk->nama)
@section('page_title', 'Detail Data Penduduk')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Top Actions -->
    <div class="flex items-center justify-between">
        <a href="{{ route('warga.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors">
            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>

        <div class="flex gap-3">
            @can('edit residents')
            <a href="{{ route('warga.edit', $penduduk->id) }}" class="btn-secondary bg-white !text-slate-700 border-slate-200 hover:bg-slate-50">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Ubah Data
            </a>
            @endcan
            <button class="btn-secondary bg-white !text-slate-700 border-slate-200 hover:bg-slate-50">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Profil
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Profile Info -->
        <div class="lg:col-span-1 space-y-6">
            <div class="card p-8 flex flex-col items-center text-center">
                <div class="relative mb-6">
                    <div class="h-32 w-32 rounded-full bg-brand-blue-50 border-4 border-white shadow-md flex items-center justify-center text-brand-blue-600 text-4xl font-bold">
                        {{ substr($penduduk->nama, 0, 1) }}
                    </div>
                    <span class="absolute bottom-2 right-2 h-6 w-6 rounded-full border-2 border-white {{ $penduduk->status == 'aktif' ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                </div>
                <h3 class="text-xl font-bold text-slate-900">{{ $penduduk->nama }}</h3>
                <p class="text-sm text-slate-500 font-mono mt-1">{{ $penduduk->nik }}</p>
                <div class="mt-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $penduduk->status == 'aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                    {{ $penduduk->status }}
                </div>
            </div>

            <div class="card overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 uppercase tracking-widest text-[10px] font-bold text-slate-500">
                    Informasi Kontak
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded bg-brand-green-50 flex items-center justify-center text-brand-green-600">
                             <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 uppercase font-bold">WhatsApp / No. HP</p>
                            <p class="text-sm font-medium text-slate-700">{{ $penduduk->no_hp ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Detail Tabs -->
        <div class="lg:col-span-2 space-y-6">
            <div class="card overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100">
                    <h4 class="font-bold text-slate-900 uppercase tracking-tight">Informasi Data Lengkap</h4>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                        <div class="space-y-1">
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Nomor Induk Kependudukan</p>
                            <p class="text-slate-900 font-medium font-mono">{{ $penduduk->nik }}</p>
                        </div>
                        <div class="space-y-1 text-right md:text-left">
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Nomor Kartu Keluarga</p>
                            @if($penduduk->keluarga)
                                <a href="{{ route('keluarga.show', $penduduk->keluarga->id) }}" class="text-brand-blue-600 font-medium font-mono hover:underline hover:text-brand-blue-800">
                                    {{ $penduduk->keluarga->no_kk }}
                                </a>
                            @else
                                <p class="text-slate-400 italic font-mono">-</p>
                            @endif
                        </div>

                        <div class="space-y-1">
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Jenis Kelamin</p>
                            <p class="text-slate-900 font-medium">{{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Tempat, Tanggal Lahir</p>
                            <p class="text-slate-900 font-medium">{{ $penduduk->tempat_lahir }}, {{ $penduduk->tanggal_lahir?->format('d F Y') ?? '-' }}</p>
                        </div>
                        <div class="space-y-1 text-right md:text-left">
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Agama</p>
                            <p class="text-slate-900 font-medium">{{ $penduduk->agama ?? '-' }}</p>
                        </div>

                        <div class="md:col-span-2 border-t border-slate-50 pt-6 mt-2"></div>

                        <div class="space-y-1">
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Pendidikan Terakhir</p>
                            <p class="text-slate-900 font-medium">{{ $penduduk->pendidikan_terakhir ?? '-' }}</p>
                        </div>
                        <div class="space-y-1 text-right md:text-left">
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Pekerjaan</p>
                            <p class="text-slate-900 font-medium">{{ $penduduk->pekerjaan ?? '-' }}</p>
                        </div>

                        <div class="space-y-1">
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Status Perkawinan</p>
                            <p class="text-slate-900 font-medium">{{ $penduduk->status_perkawinan ?? '-' }}</p>
                        </div>
                        <div class="space-y-1 text-right md:text-left">
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Kewarganegaraan</p>
                            <p class="text-slate-900 font-medium font-mono">{{ $penduduk->kewarganegaraan }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audit Trail Summary -->
            @can('view audit logs')
            <div class="card p-6 bg-slate-50 border-dashed border-2 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-600 uppercase">Audit Trail Terakhir</p>
                        <p class="text-xs text-slate-400 mt-0.5">Dibuat oleh: {{ $penduduk->creator?->name ?? 'System' }} pada {{ $penduduk->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
                <a href="#" class="text-xs font-bold text-brand-blue-600 hover:text-brand-blue-800">Lihat Log Lengkap</a>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection
