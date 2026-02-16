@extends('layouts.admin')

@section('title', 'Tambah Jenis Surat')
@section('page_title', 'Tambah Jenis Surat')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('jenis-surat.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors mb-6">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>

    <div class="card p-8">
        <form action="{{ route('jenis-surat.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="space-y-6">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight">Informasi Dasar</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="nama" :value="__('Nama Jenis Surat')" />
                        <x-text-input id="nama" name="nama" type="text" class="block w-full" :value="old('nama')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="kode" :value="__('Kode Singkat (Unique)')" />
                        <x-text-input id="kode" name="kode" type="text" class="block w-full" :value="old('kode')" required placeholder="Contoh: SKU" />
                        <x-input-error class="mt-2" :messages="$errors->get('kode')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="urutan" :value="__('Urutan Tampil')" />
                        <x-text-input id="urutan" name="urutan" type="number" class="block w-full" :value="old('urutan', 0)" />
                        <x-input-error class="mt-2" :messages="$errors->get('urutan')" />
                    </div>

                    <div class="flex items-center gap-4 h-full pt-8">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-slate-700">Status Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="space-y-2">
                    <x-input-label for="keterangan" :value="__('Keterangan / Deskripsi')" />
                    <textarea id="keterangan" name="keterangan" rows="3" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">{{ old('keterangan') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('keterangan')" />
                </div>

                <div class="space-y-2">
                    <x-input-label for="persyaratan" :value="__('Persyaratan (List)')" />
                    <textarea id="persyaratan" name="persyaratan" rows="4" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500" placeholder="Satu baris per persyaratan">{{ old('persyaratan') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('persyaratan')" />
                    <p class="text-xs text-slate-400">Tuliskan persyaratan yang harus dipenuhi oleh pemohon.</p>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('jenis-surat.index') }}" class="btn-secondary py-3 px-6 bg-white !text-slate-600 border-slate-200 hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit" class="btn-primary py-3 px-10 text-white">
                    Simpan Jenis Surat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
