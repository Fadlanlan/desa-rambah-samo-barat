@extends('layouts.admin')

@section('title', 'Ubah Penduduk - ' . $penduduk->nama)
@section('page_title', 'Ubah Data Penduduk')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Link -->
    <a href="{{ route('warga.show', $penduduk->id) }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Detail
    </a>

    <div class="card p-8">
        <form action="{{ route('warga.update', $penduduk->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Section 1: Data Identitas -->
            <div class="space-y-6">
                <div class="border-b border-slate-100 pb-2 flex justify-between items-end">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight">Identitas Dasar</h3>
                        <p class="text-xs text-slate-500">Informasi utama sesuai kartu identitas resmi.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="no_kk" :value="__('Nomor Kartu Keluarga (No KK)')" />
                        <x-text-input id="no_kk" name="no_kk" type="text" class="block w-full" :value="old('no_kk', $penduduk->keluarga?->no_kk)" minlength="16" maxlength="16" />
                        <p class="text-[10px] text-slate-500">Isi untuk memindahkan penduduk ke Keluarga lain.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('no_kk')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="nik" :value="__('Nomor Induk Kependudukan (NIK)')" />
                        <x-text-input id="nik" name="nik" type="text" class="block w-full bg-slate-50" :value="old('nik', $penduduk->nik)" required readonly />
                        <p class="text-[10px] text-slate-400 italic mt-1">NIK tidak dapat diubah untuk integritas data.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('nik')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="nama" :value="__('Nama Lengkap')" />
                        <x-text-input id="nama" name="nama" type="text" class="block w-full" :value="old('nama', $penduduk->nama)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                        <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="block w-full" :value="old('tempat_lahir', $penduduk->tempat_lahir)" />
                        <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                        <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="block w-full" :value="old('tanggal_lahir', $penduduk->tanggal_lahir?->format('Y-m-d'))" />
                        <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                        <select id="jenis_kelamin" name="jenis_kelamin" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                            <option value="L" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="agama" :value="__('Agama')" />
                        <x-text-input id="agama" name="agama" type="text" class="block w-full" :value="old('agama', $penduduk->agama)" />
                        <x-input-error class="mt-2" :messages="$errors->get('agama')" />
                    </div>
                </div>
            </div>

            <!-- Section 2: Informasi Tambahan -->
            <div class="space-y-6">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight">Kualifikasi & Status</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="pekerjaan" :value="__('Pekerjaan')" />
                        <x-text-input id="pekerjaan" name="pekerjaan" type="text" class="block w-full" :value="old('pekerjaan', $penduduk->pekerjaan)" />
                        <x-input-error class="mt-2" :messages="$errors->get('pekerjaan')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="status" :value="__('Status Keaktifan')" />
                        <select id="status" name="status" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                            <option value="aktif" {{ old('status', $penduduk->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="meninggal" {{ old('status', $penduduk->status) == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                            <option value="pindah" {{ old('status', $penduduk->status) == 'pindah' ? 'selected' : '' }}>Pindah</option>
                            <option value="hilang" {{ old('status', $penduduk->status) == 'hilang' ? 'selected' : '' }}>Hilang</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('warga.show', $penduduk->id) }}" class="btn-secondary py-3 px-6 bg-white !text-slate-600 border-slate-200 hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit" class="btn-primary py-3 px-10">
                    Perbarui Data Warga
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
