@extends('layouts.admin')

@section('title', 'Ubah Keluarga - ' . $keluarga->no_kk)
@section('page_title', 'Ubah Data Kartu Keluarga')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Link -->
    <a href="{{ route('keluarga.show', $keluarga->id) }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Detail
    </a>

    <div class="card p-8">
        <form action="{{ route('keluarga.update', $keluarga->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Section 1: Data Utama KK -->
            <div class="space-y-6">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight">Informasi Dasar KK</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="no_kk" :value="__('Nomor Kartu Keluarga')" />
                        <x-text-input id="no_kk" name="no_kk" type="text" class="block w-full bg-slate-50" :value="old('no_kk', $keluarga->no_kk)" required readonly />
                        <p class="text-[10px] text-slate-400 italic mt-1">Nomor KK tidak dapat diubah.</p>
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="kepala_keluarga" :value="__('Nama Kepala Keluarga')" />
                        <x-text-input id="kepala_keluarga" name="kepala_keluarga" type="text" class="block w-full" :value="old('kepala_keluarga', $keluarga->kepala_keluarga)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('kepala_keluarga')" />
                    </div>
                </div>
            </div>

            <!-- Section 2: Alamat Lengkap -->
            <div class="space-y-6">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight">Alamat Domisili</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2 space-y-2">
                        <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
                        <textarea id="alamat" name="alamat" rows="2" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">{{ old('alamat', $keluarga->alamat) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="rt" :value="__('RT')" />
                        <x-text-input id="rt" name="rt" type="text" class="block w-full" :value="old('rt', $keluarga->rt)" />
                        <x-input-error class="mt-2" :messages="$errors->get('rt')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="rw" :value="__('RW')" />
                        <x-text-input id="rw" name="rw" type="text" class="block w-full" :value="old('rw', $keluarga->rw)" />
                        <x-input-error class="mt-2" :messages="$errors->get('rw')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="dusun" :value="__('Dusun / Wilayah')" />
                        <select id="dusun" name="dusun" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                             <option value="">Pilih Dusun</option>
                             <option value="Dusun I" {{ old('dusun', $keluarga->dusun) == 'Dusun I' ? 'selected' : '' }}>Dusun I</option>
                             <option value="Dusun II" {{ old('dusun', $keluarga->dusun) == 'Dusun II' ? 'selected' : '' }}>Dusun II</option>
                             <option value="Dusun III" {{ old('dusun', $keluarga->dusun) == 'Dusun III' ? 'selected' : '' }}>Dusun III</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('dusun')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="kode_pos" :value="__('Kode Pos')" />
                        <x-text-input id="kode_pos" name="kode_pos" type="text" class="block w-full" :value="old('kode_pos', $keluarga->kode_pos)" />
                        <x-input-error class="mt-2" :messages="$errors->get('kode_pos')" />
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('keluarga.show', $keluarga->id) }}" class="btn-secondary py-3 px-6 bg-white !text-slate-600 border-slate-200 hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit" class="btn-primary py-3 px-10">
                    Perbarui Data Keluarga
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
