@extends('layouts.admin')

@section('title', 'Manajemen Berita - Desa Rambah Samo Barat')
@section('page_title', 'Artikel & Berita Desa')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-3 bg-brand-blue-50 rounded-lg text-brand-blue-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v4a2 2 0 002 2h4"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h10"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-900">Daftar Artikel</h3>
                <p class="text-sm text-slate-500">Kelola konten berita, pengumuman, dan artikel edukasi untuk warga.</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @can('berita.create')
            <a href="{{ route('berita.create') }}" class="btn-primary">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tulis Berita
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
                        <th class="px-6 py-4">Berita</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Penulis</th>
                        <th class="px-6 py-4">Tgl Terbit</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @if ($news->count() > 0)
                        @foreach ($news as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="h-10 w-16 object-cover rounded-lg border border-slate-100 shadow-sm" alt="">
                                    @else
                                    <div class="h-10 w-16 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 leading-tight max-w-xs truncate">{{ $item->judul }}</p>
                                        @if ($item->is_featured)
                                        <span class="inline-flex items-center text-[10px] font-bold text-amber-600 uppercase tracking-widest mt-1">
                                            <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            Unggulan
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider" style="background-color: {{ $item->category?->color ?? '#f1f5f9' }}20; color: {{ $item->category?->color ?? '#64748b' }}">
                                    {{ $item->category?->name ?? 'Tanpa Kategori' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->is_published)
                                <span class="inline-flex items-center text-emerald-600 font-bold text-xs">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                    Terbit
                                </span>
                                @else
                                <span class="inline-flex items-center text-slate-400 font-bold text-xs uppercase tracking-widest">
                                    Draft
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-medium text-slate-600">
                                {{ $item->penulis?->name ?? 'Admin' }}
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500">
                                {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @can('berita.edit')
                                <a href="{{ route('berita.edit', $item->id) }}" class="text-brand-blue-600 hover:text-brand-blue-800 transition-colors" title="Edit Berita">
                                    <svg class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                @endcan

                                @can('berita.delete')
                                <form action="{{ route('berita.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors" title="Hapus Berita">
                                        <svg class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center text-slate-400 italic">
                                 Belum ada berita yang ditulis.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        @if($news->hasPages())
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
            {{ $news->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
