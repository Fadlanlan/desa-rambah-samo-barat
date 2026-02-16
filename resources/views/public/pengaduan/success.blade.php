@extends('layouts.public')

@section('title', 'Aduan Berhasil Dikirim')

@section('content')
<section class="py-20 bg-slate-50 min-h-screen flex items-center">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-10 text-center space-y-8">
            <div class="w-24 h-24 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto scale-110">
                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            
            <div class="space-y-2">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Terima Kasih!</h1>
                <p class="text-slate-500 text-sm">Aduan Anda telah kami terima dan akan segera ditindaklanjuti.</p>
            </div>

            <div class="bg-slate-900 rounded-2xl p-8 relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-brand-blue-500/10 rounded-full blur-2xl group-hover:bg-brand-blue-500/20 transition-all"></div>
                <p class="text-[10px] text-white/50 uppercase font-black tracking-[0.2em] mb-3">Nomor Tiket Anda</p>
                <div class="text-4xl font-mono font-black text-white tracking-widest uppercase">
                    {{ $ticket }}
                </div>
                <div class="mt-6 flex justify-center">
                    <button onclick="navigator.clipboard.writeText('{{ $ticket }}')" class="flex items-center gap-2 text-[10px] font-bold text-brand-blue-400 hover:text-white uppercase tracking-widest transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                        Salin Nomor Tiket
                    </button>
                </div>
            </div>

            <div class="text-left bg-amber-50 rounded-2xl p-6 border border-amber-100">
                <h4 class="text-xs font-bold text-amber-900 uppercase tracking-widest flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Penting
                </h4>
                <p class="text-xs text-amber-800 leading-relaxed">
                    Simpan nomor tiket ini untuk melacak status penanganan aduan Anda secara berkala. Kami akan merespon aduan dalam waktu maksimal 2x24 jam kerja.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                <a href="{{ route('public.pengaduan.check', ['ticket' => $ticket]) }}" class="bg-brand-blue-600 hover:bg-brand-blue-700 text-white text-xs font-black uppercase tracking-widest px-8 py-4 rounded-xl shadow-lg shadow-brand-blue-100 transition-all flex items-center justify-center gap-2">
                    Cek Status Sekarang
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
                <a href="{{ route('home') }}" class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-black uppercase tracking-widest px-8 py-4 rounded-xl transition-all">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
