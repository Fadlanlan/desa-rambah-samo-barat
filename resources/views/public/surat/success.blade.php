@extends('layouts.public')

@section('title', 'Permohonan Berhasil - Desa Rambah Samo Barat')

@section('content')
<div class="relative pt-32 pb-20 overflow-hidden min-h-[80vh] flex items-center">
    <!-- Background Accents -->
    <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-emerald-50 rounded-full blur-3xl opacity-50"></div>
    
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <!-- Success Icon -->
        <div class="mb-8 relative inline-block">
            <div class="w-24 h-24 bg-emerald-100 rounded-3xl flex items-center justify-center mx-auto text-emerald-600 animate-bounce-slow">
                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div class="absolute -top-2 -right-2 w-8 h-8 bg-brand-blue-500 rounded-full border-4 border-white flex items-center justify-center text-white animate-pulse">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            </div>
        </div>

        <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-4">Permohonan Terkirim!</h1>
        <p class="text-lg text-slate-600 mb-8">Terima kasih. Permohonan surat Anda telah berhasil kami terima dan akan segera diproses oleh staf kantor desa.</p>

        <div class="card p-6 bg-slate-50 border-slate-100 mb-10">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">NIK Pemohon</p>
            <p class="text-2xl font-mono font-bold text-brand-blue-600 tracking-widest">{{ session('success_nik') ?? 'HIDDEN' }}</p>
        </div>

        <div class="space-y-4">
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="btn-secondary px-10 py-4 rounded-2xl font-bold flex items-center justify-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('public.surat.create') }}" class="btn-primary bg-emerald-600 hover:bg-emerald-700 shadow-emerald-100 px-10 py-4 rounded-2xl font-bold flex items-center justify-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Permohonan Lain
                </a>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-slate-100">
            <p class="text-sm text-slate-500 italic">"Pelayanan cepat, transparan, dan akuntabel untuk seluruh warga Desa Rambah Samo Barat."</p>
        </div>
    </div>
</div>
@endsection
