@extends('layouts.admin')

@section('title', 'Import Data Keluarga - Desa Rambah Samo Barat')
@section('page_title', 'Import Data Keluarga')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-3 bg-brand-green-50 rounded-lg text-brand-green-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-900">Import Data Keluarga</h3>
                <p class="text-sm text-slate-500">Upload file Excel untuk mengimpor data Kartu Keluarga.</p>
            </div>
        </div>
        <a href="{{ route('keluarga.index') }}" class="btn-secondary bg-white !text-slate-700 border border-slate-200">
            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-red-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <div class="card p-6">
        <div class="mb-6 flex justify-end">
            <a href="{{ route('keluarga.import.template') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Download Template Excel
            </a>
        </div>

        <form action="{{ route('keluarga.import.preview') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">File Excel (.xlsx / .xls)</label>
                <input type="file" name="file" accept=".xlsx,.xls" required
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-green-50 file:text-brand-green-700 hover:file:bg-brand-green-100 border border-slate-200 rounded-lg cursor-pointer">
                @error('file')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-slate-50 rounded-lg p-4 text-sm text-slate-600">
                <p class="font-bold text-slate-700 mb-2">Format Kolom Excel yang Diharapkan:</p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">no_kk</span>
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">kepala_keluarga</span>
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">alamat</span>
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">rt</span>
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">rw</span>
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">dusun</span>
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">kelurahan</span>
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">kecamatan</span>
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">kabupaten</span>
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">provinsi</span>
                    <span class="px-2 py-1 bg-white rounded border text-xs font-mono">kode_pos</span>
                </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Preview Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
