@extends('layouts.admin')

@section('title', 'Buat Permohonan Surat')
@section('page_title', 'Buat Permohonan Surat')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('surat.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors mb-6">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>

    <div class="card p-8">
        <form action="{{ route('surat.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="space-y-6">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight">Data Permohonan</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="penduduk_id" :value="__('Pilih Penduduk')" />
                        <select id="penduduk_id" name="penduduk_id" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500 select2-enabled" required>
                            <option value="">-- Cari Penduduk --</option>
                            @foreach($penduduk as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }} ({{ $p->nik }})</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('penduduk_id')" />
                        <p class="text-[10px] text-slate-400">Pastikan data penduduk sudah terdaftar.</p>
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="jenis_surat_id" :value="__('Jenis Surat')" />
                        <select id="jenis_surat_id" name="jenis_surat_id" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($jenisSurat as $js)
                                <option value="{{ $js->id }}">{{ $js->nama }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('jenis_surat_id')" />
                    </div>
                </div>

                <div class="space-y-2">
                    <x-input-label for="keperluan" :value="__('Maksud / Tujuan Surat (Keperluan)')" />
                    <textarea id="keperluan" name="keperluan" rows="3" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500" placeholder="Contoh: Mengurus Paspor, Melamar Pekerjaan di PT. XYZ, dsb." required>{{ old('keperluan') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('keperluan')" />
                    <p class="text-[10px] text-slate-400">Jelaskan secara singkat tujuan pembuatan surat ini.</p>
                </div>

                <div class="space-y-2">
                    <x-input-label for="keterangan" :value="__('Catatan Tambahan (Opsional)')" />
                    <textarea id="keterangan" name="keterangan" rows="2" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500" placeholder="Informasi tambahan lain jika ada.">{{ old('keterangan') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('keterangan')" />
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('surat.index') }}" class="btn-secondary py-3 px-6 bg-white !text-slate-600 border-slate-200 hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit" class="btn-primary py-3 px-10 text-white">
                    Simpan Permohonan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
