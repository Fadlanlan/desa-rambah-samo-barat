@extends('layouts.admin')

@section('title', 'Tambah Kartu Keluarga - Desa Rambah Samo Barat')
@section('page_title', 'Registrasi Kartu Keluarga')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Link -->
    <a href="{{ route('keluarga.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>

    <div class="card p-8">
        <form action="{{ route('keluarga.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Section 1: Data Utama KK -->
            <div class="space-y-6">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight">Informasi Dasar KK</h3>
                    <p class="text-xs text-slate-500">Sesuai dengan lampiran fisik Kartu Keluarga.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="no_kk" :value="__('Nomor Kartu Keluarga (No. KK)')" />
                        <x-text-input id="no_kk" name="no_kk" type="text" class="block w-full" :value="old('no_kk')" required minlength="16" maxlength="16" />
                        <x-input-error class="mt-2" :messages="$errors->get('no_kk')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="kepala_keluarga" :value="__('Nama Kepala Keluarga')" />
                        <x-text-input id="kepala_keluarga" name="kepala_keluarga" type="text" class="block w-full" :value="old('kepala_keluarga')" required placeholder="Nama lengkap sesuai KK" />
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
                        <textarea id="alamat" name="alamat" rows="2" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">{{ old('alamat') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="rt" :value="__('RT')" />
                        <x-text-input id="rt" name="rt" type="text" class="block w-full" :value="old('rt')" placeholder="001" />
                        <x-input-error class="mt-2" :messages="$errors->get('rt')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="rw" :value="__('RW')" />
                        <x-text-input id="rw" name="rw" type="text" class="block w-full" :value="old('rw')" placeholder="002" />
                        <x-input-error class="mt-2" :messages="$errors->get('rw')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="dusun" :value="__('Dusun / Wilayah')" />
                        <select id="dusun" name="dusun" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                             <option value="">Pilih Dusun</option>
                             <option value="Dusun I" {{ old('dusun') == 'Dusun I' ? 'selected' : '' }}>Dusun I</option>
                             <option value="Dusun II" {{ old('dusun') == 'Dusun II' ? 'selected' : '' }}>Dusun II</option>
                             <option value="Dusun III" {{ old('dusun') == 'Dusun III' ? 'selected' : '' }}>Dusun III</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('dusun')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="kode_pos" :value="__('Kode Pos')" />
                        <x-text-input id="kode_pos" name="kode_pos" type="text" class="block w-full" :value="old('kode_pos')" placeholder="28457" />
                        <x-input-error class="mt-2" :messages="$errors->get('kode_pos')" />
                    </div>
                </div>
            </div>

            <div class="pt-4 p-4 bg-amber-50 rounded-lg border border-amber-100 flex gap-3">
                 <svg class="h-5 w-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                 <p class="text-xs text-amber-800 leading-relaxed">
                     <strong>Catatan:</strong> Setelah membuat Kartu Keluarga, Anda dapat menambahkan anggota keluarga melalui menu <strong>Data Penduduk</strong> dengan menghubungkannya ke No. KK ini.
                 </p>
            </div>

            <!-- Actions -->
            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('keluarga.index') }}" class="btn-secondary py-3 px-6 bg-white !text-slate-600 border-slate-200 hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit" class="btn-primary py-3 px-10">
                    Simpan Data Keluarga
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
