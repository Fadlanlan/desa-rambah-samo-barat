@extends('layouts.public')

@section('title', 'Layanan Mandiri Surat - Desa Rambah Samo Barat')

@section('content')
<div class="relative pt-32 pb-20 overflow-hidden">
    <!-- Background Accents -->
    <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-brand-blue-50 rounded-full blur-3xl opacity-50"></div>
    <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-96 h-96 bg-brand-green-50 rounded-full blur-3xl opacity-50"></div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1.5 bg-brand-blue-50 text-brand-blue-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-4">Layanan Digital</span>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight mb-4">Permohonan Surat</h1>
            <p class="text-lg text-slate-600 max-w-xl mx-auto">Ajukan permohonan surat kedesaan secara mandiri dengan cepat, mudah, dan transparan.</p>
        </div>

        @if(session('error'))
        <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl flex items-start gap-3 animate-shake">
            <svg class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div>
                <p class="text-sm font-bold text-red-800">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <!-- Form Card -->
            <form action="{{ route('public.surat.store') }}" method="POST" class="space-y-8" id="request-form">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NIK Section -->
                    <div class="space-y-2">
                        <label for="nik" class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            NIK (Nomor Induk Kependudukan)
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative group">
                            <input type="text" name="nik" id="nik" maxlength="16" required value="{{ old('nik') }}"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-slate-900 font-mono text-sm tracking-widest focus:ring-4 focus:ring-brand-blue-100 focus:border-brand-blue-500 transition-all placeholder:text-slate-300"
                                placeholder="35XXXXXXXXXXXXXXXX">
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-brand-blue-500 transition-colors">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0a2 2 0 014 0"></path></svg>
                            </div>
                        </div>
                        @error('nik')<p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Nama Section -->
                    <div class="space-y-2">
                        <label for="nama" class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            Nama Lengkap Sesuai KTP
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative group">
                            <input type="text" name="nama" id="nama" required value="{{ old('nama') }}"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-slate-900 font-bold text-sm focus:ring-4 focus:ring-brand-blue-100 focus:border-brand-blue-500 transition-all placeholder:text-slate-300 capitalize"
                                placeholder="Masukkan nama lengkap...">
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-brand-blue-500 transition-colors">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        </div>
                        @error('nama')<p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Jenis Surat Section -->
                <div class="space-y-2">
                    <label for="jenis_surat_id" class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        Jenis Surat yang Diperlukan
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <select name="jenis_surat_id" id="jenis_surat_id" required
                            class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-slate-900 font-bold text-sm focus:ring-4 focus:ring-brand-blue-100 focus:border-brand-blue-500 transition-all appearance-none cursor-pointer">
                            <option value="">Pilih jenis surat...</option>
                            @foreach($jenisSurat as $js)
                                <option value="{{ $js->id }}" {{ old('jenis_surat_id') == $js->id ? 'selected' : '' }}>{{ $js->nama }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none group-focus-within:text-brand-blue-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    @error('jenis_surat_id')<p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Keperluan Section -->
                <div class="space-y-2">
                    <label for="keperluan" class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        Keperluan (Tujuan Pembuatan Surat)
                        <span class="text-red-500">*</span>
                    </label>
                    <textarea name="keperluan" id="keperluan" rows="4" required
                        class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-slate-900 text-sm focus:ring-4 focus:ring-brand-blue-100 focus:border-brand-blue-500 transition-all placeholder:text-slate-300 resize-none h-32"
                        placeholder="Contoh: Untuk persyaratan pendaftaran sekolah, syarat melamar pekerjaan, dsb...">{{ old('keperluan') }}</textarea>
                    @error('keperluan')<p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Submit Section -->
                <div class="pt-4">
                    <button type="submit" 
                        class="w-full bg-brand-blue-600 hover:bg-brand-blue-700 text-white font-black py-5 px-8 rounded-2xl shadow-xl shadow-brand-blue-200 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        AJUKAN PERMOHONAN SEKARANG
                    </button>
                    <p class="text-center text-[10px] text-slate-400 mt-6 uppercase tracking-widest font-bold">
                        Data anda dijamin kerahasiaannya & terenkripsi oleh sistem desa.
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer Info -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="p-6">
                <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center mx-auto mb-4 text-brand-blue-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h4 class="text-sm font-bold text-slate-800 mb-1">Cepat & Responsif</h4>
                <p class="text-[10px] text-slate-500">Diproses dalam hitungan jam kerja.</p>
            </div>
            <div class="p-6">
                <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center mx-auto mb-4 text-brand-green-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h4 class="text-sm font-bold text-slate-800 mb-1">Keamanan Data</h4>
                <p class="text-[10px] text-slate-500">Validasi NIK real-time dengan basis data desa.</p>
            </div>
            <div class="p-6">
                <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center mx-auto mb-4 text-amber-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
                <h4 class="text-sm font-bold text-slate-800 mb-1">Notifikasi</h4>
                <p class="text-[10px] text-slate-500">Ketahui status surat Anda secara langsung.</p>
            </div>
        </div>
    </div>
</div>
@endsection
