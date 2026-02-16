@extends('layouts.admin')

@section('title', 'Detail Keluarga - ' . $keluarga->no_kk)
@section('page_title', 'Detail Kartu Keluarga')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Top Actions -->
    <div class="flex items-center justify-between">
        <a href="{{ route('keluarga.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors">
            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>

        <div class="flex gap-3">
            @can('edit families')
            <a href="{{ route('keluarga.edit', $keluarga->id) }}" class="btn-secondary bg-white !text-slate-700 border-slate-200 hover:bg-slate-50">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Ubah Data KK
            </a>
            @endcan
        </div>
    </div>

    <!-- Header Card -->
    <div class="card p-8 bg-gradient-to-br from-brand-blue-900 to-brand-blue-800 text-white relative overflow-hidden">
        <div class="absolute right-0 bottom-0 opacity-10 -mr-16 -mb-16">
             <svg class="h-64 w-64" fill="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        </div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <p class="text-brand-blue-200 text-xs font-bold uppercase tracking-[0.2em] mb-2">Nomor Kartu Keluarga</p>
                <h2 class="text-3xl md:text-4xl font-black font-mono tracking-tighter">{{ $keluarga->no_kk }}</h2>
                <div class="mt-4 flex flex-wrap gap-4 text-sm text-brand-blue-100">
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Kepala: <span class="font-bold text-white ml-1">{{ $keluarga->kepala_keluarga }}</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                <p class="text-[10px] text-brand-blue-200 uppercase font-bold mb-1">Dusun / Wilayah</p>
                <p class="text-xl font-bold">{{ $keluarga->dusun ?? '-' }}</p>
                <p class="text-xs text-brand-blue-200 mt-1 uppercase tracking-widest font-bold">RT {{ $keluarga->rt ?? '00' }} / RW {{ $keluarga->rw ?? '00' }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Address & Meta -->
        <div class="lg:col-span-1 space-y-6">
            <div class="card overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 uppercase tracking-widest text-[10px] font-bold text-slate-500">
                    Alamat Domisili
                </div>
                <div class="p-6">
                    <p class="text-sm text-slate-600 leading-relaxed italic">
                        "{{ $keluarga->alamat ?? 'Alamat belum dilengkapi.' }}"
                    </p>
                    <div class="mt-4 pt-4 border-t border-slate-50 grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] text-slate-400 uppercase font-bold">Kecamatan</p>
                            <p class="text-xs font-medium text-slate-700">{{ $keluarga->kecamatan ?? 'Rambah Samo' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 uppercase font-bold">Kode Pos</p>
                            <p class="text-xs font-medium text-slate-700">{{ $keluarga->kode_pos ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-6">
                 <h4 class="text-sm font-bold text-slate-900 uppercase tracking-tight mb-4 text-center">Statistik Mini Keluarga</h4>
                 <div class="grid grid-cols-2 gap-4">
                    <div class="p-3 bg-slate-50 rounded-xl text-center">
                        <span class="block text-2xl font-black text-brand-blue-600">{{ $keluarga->anggota?->count() ?? 0 }}</span>
                        <span class="text-[10px] text-slate-500 uppercase font-bold">Anggota</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl text-center">
                        <span class="block text-2xl font-black text-brand-green-600">
                            {{ $keluarga->anggota?->where('status', 'aktif')->count() ?? 0 }}
                        </span>
                        <span class="text-[10px] text-slate-500 uppercase font-bold">Aktif</span>
                    </div>
                 </div>
            </div>
        </div>

        <!-- Members Table -->
        <div class="lg:col-span-2">
            <div class="card overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-white">
                    <h4 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Daftar Anggota Keluarga</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-slate-500 text-[10px] uppercase tracking-wider font-bold">
                            <tr>
                                <th class="px-6 py-4">NIK</th>
                                <th class="px-6 py-4">Nama</th>
                                <th class="px-6 py-4">Status Hubungan</th>
                                <th class="px-6 py-4 text-right">Profil</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if ($keluarga->anggota->count() > 0)
                                @foreach ($keluarga->anggota as $member)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-mono text-xs text-slate-500">{{ $member->nik }}</td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-slate-900 text-sm">{{ $member->nama }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $member->status_hubungan == 'Kepala Keluarga' ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-700' }}">
                                            {{ $member->status_hubungan ?? 'Anggota' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('warga.show', $member->id) }}" class="text-brand-blue-600 hover:text-brand-blue-800 transition-colors">
                                             <svg class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                                        Belum ada anggota keluarga yang terdaftar.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-4 flex justify-end">
                <a href="{{ route('warga.create', ['keluarga_id' => $keluarga->id]) }}" class="text-xs font-bold text-brand-blue-600 hover:text-brand-blue-800 flex items-center gap-1">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Anggota Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
