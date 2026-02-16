@extends('layouts.public')

@section('title', 'Booking Antrian Berhasil')

@section('content')
<section class="py-20 bg-slate-50 min-h-screen flex items-center">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-10 text-center space-y-8">
            <div class="w-24 h-24 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto scale-110">
                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            
            <div class="space-y-2">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Booking Berhasil!</h1>
                <p class="text-slate-500 text-sm">Nomor antrian Anda telah diterbitkan secara otomatis oleh sistem.</p>
            </div>

            <div class="bg-slate-900 rounded-2xl p-8 relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-brand-blue-500/10 rounded-full blur-2xl group-hover:bg-brand-blue-500/20 transition-all"></div>
                <p class="text-[10px] text-white/50 uppercase font-black tracking-[0.2em] mb-3">Nomor Antrian Anda</p>
                <div class="text-5xl font-mono font-black text-white tracking-widest uppercase mb-2">
                    {{ $antrian->nomor_antrian }}
                </div>
                <div class="text-xs text-brand-blue-400 font-bold uppercase tracking-widest">
                    {{ date('d M Y', strtotime($antrian->tanggal_kunjungan)) }} | Sesi {{ $antrian->jam_kunjungan }}
                </div>
            </div>

            <div class="text-left bg-slate-50 rounded-2xl p-6 border border-slate-100 space-y-4">
                <div class="flex justify-between items-center border-b border-white pb-3">
                    <span class="text-xs text-slate-400 uppercase font-bold">Nama</span>
                    <span class="text-sm font-bold text-slate-800">{{ $antrian->nama_pengunjung }}</span>
                </div>
                <div class="flex justify-between items-center border-b border-white pb-3">
                    <span class="text-xs text-slate-400 uppercase font-bold">Keperluan</span>
                    <span class="text-sm font-bold text-slate-800">{{ $antrian->keperluan }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs text-slate-400 uppercase font-bold">Token Akses</span>
                    <span class="text-xs font-mono font-bold text-brand-blue-600">{{ $antrian->token_akses }}</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                <a href="{{ route('public.antrian.check', ['token' => $antrian->token_akses]) }}" class="bg-brand-blue-600 hover:bg-brand-blue-700 text-white text-xs font-black uppercase tracking-widest px-8 py-4 rounded-xl shadow-lg shadow-brand-blue-100 transition-all flex items-center justify-center gap-2">
                    Lacak Antrian Real-time
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
                <button onclick="window.print()" class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-black uppercase tracking-widest px-8 py-4 rounded-xl transition-all">
                    Cetak Bukti Antrian
                </button>
            </div>

            <p class="text-[10px] text-slate-400 italic">
                *Mohon datang 15 menit sebelum waktu sesi Anda. Tunjukkan nomor antrian atau token ini kepada petugas di loket pelayanan.
            </p>
        </div>
    </div>
</section>
@endsection
