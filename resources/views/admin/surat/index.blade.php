@extends('layouts.admin')

@section('title', 'Manajemen Surat')
@section('page_title', 'Daftar Permohonan Surat')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <h3 class="text-xl font-bold text-slate-800">Tracking Surat</h3>
            <div class="flex gap-2">
                <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}" class="px-3 py-1 text-xs font-semibold rounded-full {{ !request('status') ? 'bg-slate-800 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Semua</a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'diajukan']) }}" class="px-3 py-1 text-xs font-semibold rounded-full {{ request('status') == 'diajukan' ? 'bg-amber-500 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Diajukan</a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'diproses']) }}" class="px-3 py-1 text-xs font-semibold rounded-full {{ request('status') == 'diproses' ? 'bg-brand-blue-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Diproses</a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'selesai']) }}" class="px-3 py-1 text-xs font-semibold rounded-full {{ request('status') == 'selesai' ? 'bg-emerald-500 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Selesai</a>
            </div>
        </div>
        @can('surat.create')
        <a href="{{ route('surat.create') }}" class="btn-primary">
            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Permohonan
        </a>
        @endcan
    </div>

    <!-- Filters -->
    <div class="card p-4">
        <form action="{{ route('surat.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama/NIK/No Surat..." class="w-full pl-10 pr-4 py-2 border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                <svg class="absolute left-3 top-2.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <div>
                <select name="jenis_surat_id" class="w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                    <option value="">Semua Jenis Surat</option>
                    @foreach($jenisSurat as $js)
                        <option value="{{ $js->id }}" {{ request('jenis_surat_id') == $js->id ? 'selected' : '' }}>{{ $js->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="btn-secondary py-2 px-6">Filter Data</button>
            </div>
        </form>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-[10px] uppercase tracking-wider font-bold">
                    <tr>
                        <th class="px-6 py-4">No. Surat / Tanggal</th>
                        <th class="px-6 py-4">Pemohon</th>
                        <th class="px-6 py-4">Jenis Surat</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @if ($items->count() > 0)
                        @foreach ($items as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-mono text-xs text-brand-blue-600 font-bold uppercase truncate max-w-[150px]">
                                    {{ $item->nomor_surat ?? 'BELUM ADA NOMOR' }}
                                </div>
                                <div class="text-[10px] text-slate-400 mt-0.5">{{ $item->created_at->format('d M Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">{{ $item->penduduk->nama }}</div>
                                <div class="text-xs text-slate-500 font-mono">{{ $item->penduduk->nik }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                {{ $item->jenisSurat->nama }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        'draft' => 'bg-slate-100 text-slate-600',
                                        'diajukan' => 'bg-amber-100 text-amber-700',
                                        'menunggu' => 'bg-amber-100 text-amber-700',
                                        'diproses' => 'bg-brand-blue-100 text-brand-blue-700',
                                        'disetujui' => 'bg-emerald-100 text-emerald-700',
                                        'selesai' => 'bg-slate-700 text-white',
                                        'ditolak' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $statusClasses[$item->status] ?? 'bg-slate-100 text-slate-600' }}">
                                    {{ $item->status == 'diajukan' ? 'MENUNGGU' : $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    @if($item->file_pdf)
                                    <a href="{{ route('surat.download', $item->id) }}" class="p-1 text-emerald-600 hover:bg-emerald-50 rounded transition-colors" title="Download PDF">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </a>
                                    @endif
                                    <a href="{{ route('surat.show', $item->id) }}" class="text-brand-blue-600 hover:text-brand-blue-800 font-bold text-xs uppercase tracking-wider">
                                        Detail
                                    </a>
                                    @can('surat.delete')
                                    <form action="{{ route('surat.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus permohonan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 p-1">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic text-sm">Tidak ada data permohonan surat.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
