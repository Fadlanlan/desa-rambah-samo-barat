@extends('layouts.admin')

@section('title', 'Kotak Masuk')

@section('page_title', 'Pesan Masuk (Kontak)')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <p class="mt-2 text-sm text-slate-700">Daftar pesan dari warga atau pengunjung melalui formulir kontak.</p>
    </div>
</div>

<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-slate-300">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">Pengirim</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Subjek</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Tanggal</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @if($items->count() > 0)
                            @foreach($items as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-slate-900 sm:pl-6">
                                    {{ $item->nama }}
                                    <div class="text-xs text-slate-500">{{ $item->email }}</div>
                                    <div class="text-xs text-slate-500">{{ $item->telepon }}</div>
                                </td>
                                <td class="px-3 py-4 text-sm text-slate-500">
                                    <span class="font-medium text-slate-900">{{ \Str::limit($item->subject, 30) }}</span>
                                    <div class="text-xs text-slate-500 line-clamp-1">{{ \Str::limit($item->pesan, 50) }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                    {{ $item->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    @can('kontak.view')
                                    <a href="{{ route('kontak.show', $item->id) }}" class="text-brand-blue-600 hover:text-brand-blue-900 mr-4">Lihat</a>
                                    @endcan

                                    @can('kontak.delete')
                                    <form action="{{ route('kontak.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
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
                                <td colspan="4" class="py-10 text-center text-slate-500">Belum ada pesan masuk.</td>
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
