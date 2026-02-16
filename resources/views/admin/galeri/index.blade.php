@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('page_title', 'Manajemen Galeri')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <p class="mt-2 text-sm text-slate-700">Daftar foto dan dokumentasi kegiatan desa.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        @can('galeri.create')
        <a href="{{ route('galeri.create') }}" class="block rounded-md bg-brand-blue-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-brand-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue-600">
            Tambah Foto
        </a>
        @endcan
    </div>
</div>

<div class="mt-8">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @if($items->count() > 0)
            @foreach($items as $item)
            <div class="relative flex flex-col overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                <div class="aspect-w-16 aspect-h-9 bg-slate-200">
                    @if($item->file_path)
                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->judul }}" class="h-48 w-full object-cover">
                    @else
                        <div class="flex h-48 w-full items-center justify-center bg-slate-100 text-slate-400">
                            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex flex-1 flex-col p-4">
                    <h3 class="text-lg font-semibold text-slate-900">{{ \Str::limit($item->judul, 30) }}</h3>
                    <p class="mt-1 text-sm text-slate-500 line-clamp-2">{{ $item->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-700' }}">
                            {{ $item->is_active ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                        <div class="flex space-x-2">
                            @can('galeri.edit')
                            <a href="{{ route('galeri.edit', $item->id) }}" class="text-sm font-medium text-brand-blue-600 hover:text-brand-blue-500">Edit</a>
                            @endcan

                            @if(auth()->user()->can('galeri.edit') && auth()->user()->can('galeri.delete'))
                            <span class="text-slate-300">|</span>
                            @endif

                            @can('galeri.delete')
                            <form action="{{ route('galeri.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-500">Hapus</button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-span-full py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-slate-900">Tidak ada galeri</h3>
                <p class="mt-1 text-sm text-slate-500">Belum ada foto yang ditambahkan ke galeri.</p>
                @can('galeri.create')
                <div class="mt-6">
                    <a href="{{ route('galeri.create') }}" class="inline-flex items-center rounded-md bg-brand-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue-600">
                        Tambah Foto
                    </a>
                </div>
                @endcan
            </div>
        @endif
    </div>

    @if($items->hasPages())
    <div class="mt-6">
        {{ $items->links() }}
    </div>
    @endif
</div>
@endsection
