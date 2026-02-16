@extends('layouts.admin')

@section('title', 'Manajemen APBDes')

@section('page_title', 'Manajemen APBDes')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-slate-900">Anggaran Pendapatan &amp; Belanja Desa (APBDes)</h1>
        <p class="mt-2 text-sm text-slate-700">Daftar transparansi anggaran dan realisasi pembangunan desa.</p>
    </div>
    @can('apbdes.create')
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="{{ route('apbdes.create', ['year' => request('year')]) }}" class="block rounded-md bg-brand-blue-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-brand-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue-600">
            Tambah Data
        </a>
    </div>
    @endcan
</div>

<div class="mt-6 flex justify-between items-center bg-white p-4 rounded-lg shadow-sm border border-slate-200">
    <div class="flex items-center gap-2">
        <span class="text-sm font-medium text-slate-700">Tahun Anggaran:</span>
        <select onchange="window.location.href=this.value" class="rounded-md border-0 py-1.5 pl-3 pr-8 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-brand-blue-600 sm:text-sm sm:leading-6">
            @for($y = date('Y') + 1; $y >= 2020; $y--)
                <option value="{{ route('apbdes.index', ['year' => $y]) }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
    </div>
</div>

<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-slate-300">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">Uraian</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Jenis/Kategori</th>
                            <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-slate-900">Anggaran (Rp)</th>
                            <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-slate-900">Realisasi (Rp)</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Sumber Dana</th>
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
                                    {{ $item->uraian }}
                                    <div class="text-xs text-slate-500">{{ \Str::limit($item->keterangan, 30) }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                    <div class="capitalize font-medium">{{ $item->jenis }}</div>
                                    <div class="text-xs">{{ $item->kategori }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500 text-right font-mono">
                                    {{ number_format($item->anggaran, 0, ',', '.') }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-right font-mono {{ $item->realisasi > $item->anggaran ? 'text-red-600' : 'text-slate-500' }}">
                                    {{ number_format($item->realisasi, 0, ',', '.') }}
                                    <div class="text-xs text-slate-400">{{ $item->anggaran > 0 ? round(($item->realisasi / $item->anggaran) * 100, 1) . '%' : '0%' }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                    {{ $item->sumber_dana ?? '-' }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 space-x-2">
                                    @can('apbdes.edit')
                                    <a href="{{ route('apbdes.edit', $item->id) }}" class="text-brand-blue-600 hover:text-brand-blue-900">Edit</a>
                                    @endcan

                                    @can('apbdes.delete')
                                    <form action="{{ route('apbdes.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                                <td colspan="6" class="py-10 text-center text-slate-500">Belum ada data APBDes untuk tahun {{ request('year', date('Y')) }}.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if($items->hasPages())
            <div class="mt-4">
                {{ $items->appends(['year' => request('year')])->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
