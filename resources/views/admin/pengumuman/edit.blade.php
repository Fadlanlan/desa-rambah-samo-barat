@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('page_title', 'Edit Pengumuman')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('pengumuman.index') }}" class="text-slate-500 hover:text-slate-700">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-900">Edit Pengumuman</h1>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('pengumuman.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="judul" class="block text-sm font-medium leading-6 text-slate-900">Judul Pengumuman</label>
                        <div class="mt-2">
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $item->judul) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" required>
                        </div>
                        @error('judul')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="konten" class="block text-sm font-medium leading-6 text-slate-900">Isi Pengumuman</label>
                        <div class="mt-2">
                            <textarea id="konten" name="konten" rows="5" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6" required>{{ old('konten', $item->konten) }}</textarea>
                        </div>
                        @error('konten')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="prioritas" class="block text-sm font-medium leading-6 text-slate-900">Prioritas</label>
                            <div class="mt-2">
                                <select id="prioritas" name="prioritas" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">
                                    <option value="rendah" {{ old('prioritas', $item->prioritas) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                    <option value="sedang" {{ old('prioritas', $item->prioritas) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                    <option value="tinggi" {{ old('prioritas', $item->prioritas) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="sm:col-span-3">
                            <div class="flex items-center h-full pt-6">
                                <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-brand-blue-600 focus:ring-brand-blue-600">
                                <label for="is_active" class="ml-3 text-sm leading-6 font-medium text-slate-900">Tampilkan (Aktif)</label>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="tanggal_mulai" class="block text-sm font-medium leading-6 text-slate-900">Tanggal Mulai</label>
                            <div class="mt-2">
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', $item->tanggal_mulai ? $item->tanggal_mulai->format('Y-m-d') : '') }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="tanggal_selesai" class="block text-sm font-medium leading-6 text-slate-900">Tanggal Selesai</label>
                            <div class="mt-2">
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai', $item->tanggal_selesai ? $item->tanggal_selesai->format('Y-m-d') : '') }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-blue-600 sm:text-sm sm:leading-6">
                            </div>
                            <p class="mt-1 text-xs text-slate-500">Biarkan kosong jika berlaku selamanya.</p>
                        </div>
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
