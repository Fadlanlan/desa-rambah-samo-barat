@extends('layouts.public')

@section('title', 'Verifikasi Surat Elektronik')

@section('content')
<div class="py-20 bg-slate-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center p-3 bg-emerald-100 rounded-full text-emerald-600 mb-4">
                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Dokumen Terverifikasi</h1>
            <p class="text-slate-500 mt-2">Sistem Informasi Desa Rambah Samo Barat menyatakan dokumen ini asli.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="bg-brand-blue-900 p-8 text-white relative">
                <div class="relative z-10">
                    <p class="text-xs font-bold text-brand-blue-300 uppercase tracking-widest mb-1">Nomor Surat</p>
                    <h2 class="text-xl font-mono font-bold">{{ $surat->nomor_surat }}</h2>
                </div>
                <div class="absolute right-0 top-0 h-full w-1/3 bg-white/5 skew-x-12 transform translate-x-1/2"></div>
            </div>

            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Jenis Dokumen</p>
                        <p class="text-sm font-bold text-slate-800">{{ $surat->jenisSurat->nama }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tanggal Terbit</p>
                        <p class="text-sm font-bold text-slate-800">{{ $surat->updated_at->format('d F Y') }}</p>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-8">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Informasi Pemilik Dokumen</p>
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 mb-6">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full bg-brand-blue-100 flex items-center justify-center text-brand-blue-700 font-black text-xl">
                                {{ substr($surat->penduduk->nama, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">{{ $surat->penduduk->nama }}</h3>
                                <p class="text-xs text-slate-500 font-mono">NIK: {{ substr($surat->penduduk->nik, 0, 6) }}**********</p>
                            </div>
                        </div>
                    </div>

                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Maksud / Keperluan</p>
                    <div class="bg-white border border-slate-100 p-4 rounded-xl text-sm text-slate-700 italic mb-6">
                        "{{ $surat->keperluan }}"
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pejabat Penandatangan</p>
                            <p class="text-sm font-bold text-slate-800">{{ config('desa.kepala_desa') }}</p>
                            <p class="text-[10px] text-slate-500 uppercase">Kepala Desa {{ config('desa.nama_desa') }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status Keaslian</p>
                            <div class="flex items-center gap-1.5 text-emerald-600">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 4.946-3.07 9.173-7.393 10.8a1 1 0 01-.608 0L10 18.2a11.952 11.952 0 01-7.834-11.2c0-.68.056-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <span class="text-xs font-bold uppercase tracking-tight">Terdaftar & Sah</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($surat->hash_verifikasi)
                <div class="bg-slate-900 rounded-2xl p-6 text-white overflow-hidden relative">
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></div>
                            <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Document Integrity Hash (SHA-256)</h4>
                        </div>
                        <p class="text-[10px] font-mono text-slate-300 break-all leading-relaxed">
                            {{ $surat->hash_verifikasi }}
                        </p>
                    </div>
                    <svg class="absolute right-0 bottom-0 h-16 w-16 text-white opacity-5 transform translate-x-4 translate-y-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 4.946-3.07 9.173-7.393 10.8a1 1 0 01-.608 0L10 18.2a11.952 11.952 0 01-7.834-11.2c0-.68.056-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                @endif
            </div>

            <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 text-center">
                <a href="{{ url('/') }}" class="text-xs font-bold text-brand-blue-600 uppercase tracking-widest hover:text-brand-blue-800 transition-colors">
                    Kembali ke Website Desa
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
