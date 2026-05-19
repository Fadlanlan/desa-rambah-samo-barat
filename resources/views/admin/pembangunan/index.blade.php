@extends('layouts.admin')
@section('title', 'Laporan Pembangunan Fisik')
@section('page_title', 'Laporan Pembangunan')
@section('content')
<div class="card p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-slate-800">Manajemen Laporan Pembangunan Fisik & Infrastruktur</h2>
        <a href="{{ route('pembangunan.create') }}" class="btn-primary">Tambah Laporan</a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mb-6 font-bold text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-slate-100">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-slate-500 uppercase bg-slate-50">
                <tr>
                    <th class="px-4 py-3">Nama Proyek & Lokasi</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Anggaran vs Realisasi</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembangunans as $item)
                <tr class="border-b hover:bg-slate-50">
                    <td class="px-4 py-3">
                        <div class="font-bold text-slate-800">{{ $item->nama }}</div>
                        <div class="text-[10px] text-slate-500">{{ $item->lokasi }} (TA {{ $item->tahun }})</div>
                    </td>
                    <td class="px-4 py-3 font-semibold">{{ $item->kategori }}</td>
                    <td class="px-4 py-3 font-mono text-xs font-bold">
                        Rp {{ number_format($item->anggaran,0,',','.') }} <br>
                        <span class="text-emerald-600">Rp {{ number_format($item->realisasi,0,',','.') }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2.5 py-1 rounded-full bg-brand-blue-50 text-brand-blue-700 text-[10px] font-black uppercase tracking-wider">
                            {{ $item->status }} ({{ $item->progress }}%)
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('pembangunan.edit', $item) }}" class="text-xs font-bold text-slate-600 hover:text-brand-blue-600 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-brand-blue-50 transition-colors">Edit</a>
                            <form action="{{ route('pembangunan.destroy', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pembangunan ini?')" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-rose-600 hover:text-white px-3 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-500 transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-slate-500 font-medium">Belum ada data laporan pembangunan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $pembangunans->links() }}</div>
</div>
@endsection
