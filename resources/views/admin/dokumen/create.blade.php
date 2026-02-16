@extends('layouts.admin')

@section('title', 'Upload Dokumen')

@section('page_title', 'Upload Dokumen')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('dokumen.index') }}" class="text-slate-500 hover:text-slate-700">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-900">Upload Dokumen Baru</h1>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="judul" class="block text-sm font-medium leading-6 text-slate-900">Judul Dokumen</label>
                        <div class="mt-2">
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" required>
                        </div>
                        @error('judul')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi</label>
                        <div class="mt-2">
                            <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label for="file_path" class="block text-sm font-medium leading-6 text-slate-900">File Dokumen</label>
                        <div class="mt-2">
                            <input type="file" name="file_path" id="file_path" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand-blue-50 file:text-brand-blue-700 hover:file:bg-brand-blue-100" required>
                        </div>
                        <p class="mt-1 text-xs text-slate-500">Maksimal 10MB.</p>
                        @error('file_path')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="kategori" class="block text-sm font-medium leading-6 text-slate-900">Kategori</label>
                            <div class="mt-2">
                                <select id="kategori" name="kategori" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">
                                    <option value="Peraturan Desa" {{ old('kategori') == 'Peraturan Desa' ? 'selected' : '' }}>Peraturan Desa (Perdes)</option>
                                    <option value="SK Kepala Desa" {{ old('kategori') == 'SK Kepala Desa' ? 'selected' : '' }}>SK Kepala Desa</option>
                                    <option value="Formulir" {{ old('kategori') == 'Formulir' ? 'selected' : '' }}>Formulir</option>
                                    <option value="Laporan" {{ old('kategori') == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <div class="flex items-center h-full pt-6">
                                <input id="is_public" name="is_public" type="checkbox" value="1" {{ old('is_public', true) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-brand-blue-600 focus:ring-brand-blue-600">
                                <label for="is_public" class="ml-3 text-sm leading-6 font-medium text-slate-900">Publik (Dapat diakses warga)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" onclick="history.back()" class="text-sm font-semibold leading-6 text-slate-900">Batal</button>
                    <button type="submit" class="rounded-md bg-brand-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue-600">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
