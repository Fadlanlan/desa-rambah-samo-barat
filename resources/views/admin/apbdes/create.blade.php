@extends('layouts.admin')

@section('title', 'Tambah Data APBDes')

@section('page_title', 'Tambah Data APBDes')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('apbdes.index') }}" class="text-slate-500 hover:text-slate-700">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-900">Input Data APBDes</h1>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('apbdes.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="tahun_anggaran" class="block text-sm font-medium leading-6 text-slate-900">Tahun Anggaran</label>
                            <div class="mt-2">
                                <input type="number" name="tahun_anggaran" id="tahun_anggaran" value="{{ old('tahun_anggaran', date('Y')) }}" min="2000" max="2100" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('tahun_anggaran')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="jenis" class="block text-sm font-medium leading-6 text-slate-900">Jenis Anggaran</label>
                            <div class="mt-2">
                                <select id="jenis" name="jenis" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" required>
                                    <option value="pendapatan" {{ old('jenis') == 'pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                                    <option value="belanja" {{ old('jenis') == 'belanja' ? 'selected' : '' }}>Belanja</option>
                                    <option value="pembiayaan" {{ old('jenis') == 'pembiayaan' ? 'selected' : '' }}>Pembiayaan</option>
                                </select>
                            </div>
                            @error('jenis')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="uraian" class="block text-sm font-medium leading-6 text-slate-900">Uraian</label>
                        <div class="mt-2">
                            <input type="text" name="uraian" id="uraian" value="{{ old('uraian') }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" required>
                        </div>
                        @error('uraian')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="kategori" class="block text-sm font-medium leading-6 text-slate-900">Kategori</label>
                            <div class="mt-2">
                                <input type="text" name="kategori" id="kategori" value="{{ old('kategori') }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="sub_kategori" class="block text-sm font-medium leading-6 text-slate-900">Sub Kategori</label>
                            <div class="mt-2">
                                <input type="text" name="sub_kategori" id="sub_kategori" value="{{ old('sub_kategori') }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="anggaran" class="block text-sm font-medium leading-6 text-slate-900">Jumlah Anggaran (Rp)</label>
                            <div class="mt-2">
                                <input type="number" name="anggaran" id="anggaran" value="{{ old('anggaran', 0) }}" min="0" step="0.01" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('anggaran')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="realisasi" class="block text-sm font-medium leading-6 text-slate-900">Realisasi (Rp)</label>
                            <div class="mt-2">
                                <input type="number" name="realisasi" id="realisasi" value="{{ old('realisasi', 0) }}" min="0" step="0.01" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('realisasi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="sumber_dana" class="block text-sm font-medium leading-6 text-slate-900">Sumber Dana</label>
                        <div class="mt-2">
                            <input type="text" name="sumber_dana" id="sumber_dana" value="{{ old('sumber_dana') }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">
                        </div>
                        <p class="mt-1 text-xs text-slate-500">Contoh: DD, ADD, PAD, Banprov, dll.</p>
                    </div>

                    <div>
                        <label for="keterangan" class="block text-sm font-medium leading-6 text-slate-900">Keterangan</label>
                        <div class="mt-2">
                            <textarea id="keterangan" name="keterangan" rows="3" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" onclick="history.back()" class="text-sm font-semibold leading-6 text-slate-900">Batal</button>
                    <button type="submit" class="rounded-md bg-brand-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
