@extends('layouts.admin')

@section('title', 'Manajemen Wisata - Desa Rambah Samo Barat')
@section('page_title', 'Kelola Objek Wisata')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-3 bg-brand-blue-50 rounded-lg text-brand-blue-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-900">Daftar Wisata</h3>
                <p class="text-sm text-slate-500">Kelola objek wisata dan daya tarik desa kita.</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @can('wisata.create')
            <a href="{{ route('wisata.create') }}" class="btn-primary">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Wisata
            </a>
            @endcan
        </div>
    </div>

    <!-- Table -->
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr class="text-xs uppercase tracking-wider font-bold text-slate-500">
                        <th class="px-6 py-4">Wisata</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4">Tiket</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @if ($wisatas->count() > 0)
                        @foreach ($wisatas as $wisata)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($wisata->gambar)
                                    <img src="{{ asset('storage/' . $wisata->gambar) }}" class="h-10 w-16 object-cover rounded-lg border border-slate-100 shadow-sm" alt="">
                                    @else
                                    <div class="h-10 w-16 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-bold text-slate-900 leading-tight">{{ $wisata->nama }}</div>
                                        <div class="text-xs text-slate-500 mt-0.5">{{ Str::limit($wisata->deskripsi, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs font-medium text-slate-600">
                                {{ $wisata->lokasi ?: '-' }}
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-emerald-600">
                                {{ $wisata->harga_tiket ? 'Rp ' . number_format($wisata->harga_tiket, 0, ',', '.') : 'Gratis' }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($wisata->is_active)
                                <span class="inline-flex items-center text-emerald-600 font-bold text-xs uppercase tracking-widest">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                    Aktif
                                </span>
                                @else
                                <span class="inline-flex items-center text-slate-400 font-bold text-xs uppercase tracking-widest">
                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-300 mr-2"></span>
                                    Non-Aktif
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @can('wisata.edit')
                                <a href="{{ route('wisata.edit', $wisata->id) }}" class="text-brand-blue-600 hover:text-brand-blue-800 transition-colors" title="Edit Wisata">
                                    <svg class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                @endcan

                                @can('wisata.delete')
                                <form action="{{ route('wisata.destroy', $wisata->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data wisata ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors" title="Hapus Wisata">
                                        <svg class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center text-slate-400 italic">
                                Belum ada data wisata yang terdaftar.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        @if($wisatas->hasPages())
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
            {{ $wisatas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
