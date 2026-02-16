@extends('layouts.admin')

@section('title', 'Edit Wisata')

@section('page_title', 'Edit Wisata')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('wisata.index') }}" class="text-slate-500 hover:text-slate-700">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-900">Edit Data Wisata</h1>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('wisata.update', $wisata->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium leading-6 text-slate-900">Nama Wisata</label>
                        <div class="mt-2">
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $wisata->nama) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" required>
                        </div>
                        @error('nama')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi Wisata</label>
                        <div class="mt-2">
                            <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" required>{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
                        </div>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="lokasi" class="block text-sm font-medium leading-6 text-slate-900">Lokasi</label>
                            <div class="mt-2">
                                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $wisata->lokasi) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="harga_tiket" class="block text-sm font-medium leading-6 text-slate-900">Harga Tiket</label>
                            <div class="mt-2">
                                <input type="text" name="harga_tiket" id="harga_tiket" value="{{ old('harga_tiket', $wisata->harga_tiket) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" placeholder="Contoh: Gratis, 5.000, dll">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="jam_operasional" class="block text-sm font-medium leading-6 text-slate-900">Jam Operasional</label>
                            <div class="mt-2">
                                <input type="text" name="jam_operasional" id="jam_operasional" value="{{ old('jam_operasional', $wisata->jam_operasional) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" placeholder="Contoh: 08:00 - 17:00">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="kontak" class="block text-sm font-medium leading-6 text-slate-900">Kontak Person</label>
                            <div class="mt-2">
                                <input type="text" name="kontak" id="kontak" value="{{ old('kontak', $wisata->kontak) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium leading-6 text-slate-900">Foto Wisata Saat Ini</label>
                        <div class="mt-2 mb-4">
                            @if($wisata->gambar)
                                <img src="{{ asset('storage/' . $wisata->gambar) }}" alt="Preview" class="h-48 w-full object-cover rounded-lg border border-slate-200">
                            @else
                                <div class="h-48 w-full bg-slate-100 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500">
                                    Tidak ada foto
                                </div>
                            @endif
                        </div>

                        <label for="gambar" class="block text-sm font-medium leading-6 text-slate-900">Ganti Foto (Opsional)</label>
                        <div class="mt-2">
                            <input type="file" name="gambar" id="gambar" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand-blue-50 file:text-brand-blue-700 hover:file:bg-brand-blue-100">
                        </div>
                        <p class="mt-1 text-xs text-slate-500">Biarkan kosong jika tidak ingin mengubah foto. Maksimal 2MB.</p>
                        @error('gambar')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center">
                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $wisata->is_active) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-brand-blue-600 focus:ring-brand-blue-600">
                        <label for="is_active" class="ml-3 text-sm leading-6 font-medium text-slate-900">Tampilkan (Aktif)</label>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" onclick="history.back()" class="text-sm font-semibold leading-6 text-slate-900">Batal</button>
                    <button type="submit" class="rounded-md bg-brand-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue-600">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
