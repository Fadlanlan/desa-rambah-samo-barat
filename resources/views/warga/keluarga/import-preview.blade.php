@extends('layouts.admin')

@section('title', 'Preview Import Keluarga - Desa Rambah Samo Barat')
@section('page_title', 'Preview Import Keluarga')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-3 bg-brand-green-50 rounded-lg text-brand-green-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-900">Preview Data Keluarga</h3>
                <p class="text-sm text-slate-500">Periksa data di bawah sebelum menyimpan ke database.</p>
            </div>
        </div>
        <a href="{{ route('keluarga.import') }}" class="btn-secondary bg-white !text-slate-700 border border-slate-200">
            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Upload Ulang
        </a>
    </div>

    {{-- Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="card p-4 flex items-center gap-3">
            <div class="p-2 bg-brand-blue-50 rounded-lg text-brand-blue-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900">{{ count($validData) }}</p>
                <p class="text-xs text-slate-500">Total Baris</p>
            </div>
        </div>
        <div class="card p-4 flex items-center gap-3">
            <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-emerald-600">{{ count(array_filter($validData, fn($r) => empty($r['errors']))) }}</p>
                <p class="text-xs text-slate-500">Data Valid</p>
            </div>
        </div>
        <div class="card p-4 flex items-center gap-3">
            <div class="p-2 bg-red-50 rounded-lg text-red-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-red-600">{{ count($errors) }}</p>
                <p class="text-xs text-slate-500">Error Ditemukan</p>
            </div>
        </div>
    </div>

    {{-- Error List --}}
    @if(!empty($errors))
    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <h4 class="font-bold text-red-700 mb-2">Daftar Error:</h4>
        <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
            @foreach($errors as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Data Table --}}
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr class="text-xs uppercase tracking-wider font-bold text-slate-500">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">No. KK</th>
                        <th class="px-4 py-3">Kepala Keluarga</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Dusun</th>
                        <th class="px-4 py-3">RT/RW</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($validData as $i => $row)
                    <tr class="{{ !empty($row['errors']) ? 'bg-red-50' : 'hover:bg-slate-50/50' }} transition-colors">
                        <td class="px-4 py-3 text-xs text-slate-400">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 font-mono text-xs">{{ $row['no_kk'] }}</td>
                        <td class="px-4 py-3 font-bold text-sm text-slate-900">{{ $row['kepala_keluarga'] }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600 truncate max-w-[200px]">{{ $row['alamat'] }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $row['dusun'] }}</td>
                        <td class="px-4 py-3 text-sm text-slate-500">{{ $row['rt'] ?: '00' }}/{{ $row['rw'] ?: '00' }}</td>
                        <td class="px-4 py-3">
                            @if(empty($row['errors']))
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-700">Valid</span>
                            @else
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-red-100 text-red-700">Error</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Action --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('keluarga.import') }}" class="text-sm text-slate-500 hover:text-slate-700">← Upload file lain</a>

        @if(empty($errors))
        <form action="{{ route('keluarga.import.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn-primary" onclick="return confirm('Yakin ingin menyimpan {{ count($validData) }} data keluarga ke database?')">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Konfirmasi Simpan ({{ count($validData) }} data)
            </button>
        </form>
        @else
        <p class="text-sm text-red-600 font-medium">Perbaiki error di file Excel, lalu upload ulang.</p>
        @endif
    </div>
</div>
@endsection
