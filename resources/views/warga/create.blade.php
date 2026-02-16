@extends('layouts.admin')

@section('title', 'Tambah Penduduk - Desa Rambah Samo Barat')
@section('page_title', 'Tambah Data Penduduk')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Link -->
    <a href="{{ route('warga.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>

    <div class="card p-8">
        <form action="{{ route('warga.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Section 1: Data Identitas -->
            <div class="space-y-6">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight">Identitas Dasar</h3>
                    <p class="text-xs text-slate-500">Informasi utama sesuai kartu identitas resmi.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="no_kk" :value="__('Nomor Kartu Keluarga (No KK)')" />
                        <x-text-input id="no_kk" name="no_kk" type="text" class="block w-full" :value="old('no_kk')" minlength="16" maxlength="16" placeholder="Masukkan 16 digit No KK" />
                        <p class="text-[10px] text-slate-500">Jika diisi, data penduduk akan otomatis terhubung ke Keluarga tersebut.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('no_kk')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="nik" :value="__('Nomor Induk Kependudukan (NIK)')" />
                        <x-text-input id="nik" name="nik" type="text" class="block w-full" :value="old('nik')" required minlength="16" maxlength="16" />
                        <x-input-error class="mt-2" :messages="$errors->get('nik')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="nama" :value="__('Nama Lengkap (Sesuai KTP)')" />
                        <x-text-input id="nama" name="nama" type="text" class="block w-full" :value="old('nama')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                        <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="block w-full" :value="old('tempat_lahir')" />
                        <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                        <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="block w-full" :value="old('tanggal_lahir')" />
                        <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                        <select id="jenis_kelamin" name="jenis_kelamin" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="agama" :value="__('Agama')" />
                        <x-text-input id="agama" name="agama" type="text" class="block w-full" :value="old('agama')" placeholder="Contoh: Islam" />
                        <x-input-error class="mt-2" :messages="$errors->get('agama')" />
                    </div>
                </div>
            </div>

            <!-- Section 2: Informasi Tambahan -->
            <div class="space-y-6">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight">Kualifikasi & Kontak</h3>
                    <p class="text-xs text-slate-500">Pekerjaan, pendidikan, dan kontak yang bisa dihubungi.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="pekerjaan" :value="__('Pekerjaan')" />
                        <x-text-input id="pekerjaan" name="pekerjaan" type="text" class="block w-full" :value="old('pekerjaan')" />
                        <x-input-error class="mt-2" :messages="$errors->get('pekerjaan')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="pendidikan_terakhir" :value="__('Pendidikan Terakhir')" />
                        <x-text-input id="pendidikan_terakhir" name="pendidikan_terakhir" type="text" class="block w-full" :value="old('pendidikan_terakhir')" />
                        <x-input-error class="mt-2" :messages="$errors->get('pendidikan_terakhir')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="no_hp" :value="__('Nomor WhatsApp / HP')" />
                        <x-text-input id="no_hp" name="no_hp" type="text" class="block w-full" :value="old('no_hp')" placeholder="6281..." />
                        <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="status" :value="__('Status Keaktifan')" />
                        <select id="status" name="status" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                            <option value="aktif">Aktif</option>
                            <option value="meninggal">Meninggal</option>
                            <option value="pindah">Pindah</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('warga.index') }}" class="btn-secondary py-3 px-6 bg-white !text-slate-600 border-slate-200 hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit" class="btn-primary py-3 px-10">
                    Simpan Data Warga
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
