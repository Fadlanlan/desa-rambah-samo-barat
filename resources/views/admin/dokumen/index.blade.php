@extends('layouts.admin')

@section('title', 'Manajemen Dokumen')

@section('page_title', 'Manajemen Dokumen')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <p class="mt-2 text-sm text-slate-700">Daftar dokumen publik dan internal desa (Perdes, SK, Formulir, dll).</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        @can('dokumen.create')
        <a href="{{ route('dokumen.create') }}" class="block rounded-md bg-brand-blue-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-brand-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue-600">
            Upload Dokumen
        </a>
        @endcan
    </div>
</div>

<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-slate-300">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">Judul Dokumen</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Kategori</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">File Info</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Status</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Downloads</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @if($items->count() > 0)
                            @foreach($items as $item)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-slate-900 sm:pl-6">
                                    {{ \Str::limit($item->judul, 40) }}
                                    <div class="text-xs text-slate-500">{{ $item->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                    {{ $item->kategori ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                    <div>{{ $item->file_type }}</div>
                                    <div class="text-xs">{{ round($item->file_size / 1024, 0) }} KB</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                    @if($item->is_public)
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">Publik</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-2 py-1 text-xs font-medium text-slate-700">Internal</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                    {{ $item->download_count }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <!-- Warning: route 'dokumen.download' must be defined later -->
                                    @can('dokumen.edit')
                                    <a href="{{ route('dokumen.edit', $item->id) }}" class="text-brand-blue-600 hover:text-brand-blue-900 mr-4">Edit</a>
                                    @endcan

                                    @can('dokumen.delete')
                                    <form action="{{ route('dokumen.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="py-10 text-center text-slate-500">Belum ada data dokumen.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            @if($items->hasPages())
            <div class="mt-4">
                {{ $items->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
