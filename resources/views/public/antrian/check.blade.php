@extends('layouts.public')

@section('title', 'Lacak Antrian Real-time')

@section('content')
<section class="py-20 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Status <span class="text-brand-blue-600">Antrian Hari Ini</span></h1>
            <p class="text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Pantau progress antrian secara real-time dari manapun Anda berada.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12 mb-12">
            <form action="{{ route('public.antrian.check') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow relative">
                    <input type="text" name="token" id="token" value="{{ $token }}" class="w-full pl-12 pr-4 py-4 bg-slate-50 border-slate-100 rounded-2xl text-lg font-mono font-bold uppercase tracking-widest focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" placeholder="Masukkan Token Akses..." required>
                    <svg class="absolute left-4 top-4.5 h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                </div>
                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-black uppercase tracking-widest px-10 py-4 rounded-2xl transition-all shadow-lg active:scale-95">
                    Lacak Tiket
                </button>
            </form>
        </div>

        @if($token)
            @if($antrian)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-in fade-in slide-in-from-bottom-5 duration-700">
                    <!-- My Ticket Card -->
                    <div class="bg-slate-900 rounded-3xl shadow-2xl p-10 text-white relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-brand-blue-600/20 rounded-full blur-3xl"></div>
                        
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-10">
                                <div>
                                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-white/40 mb-1">Tiket Saya</h3>
                                    <div class="text-4xl font-mono font-black tracking-widest">{{ $antrian->nomor_antrian }}</div>
                                </div>
                                <span class="px-3 py-1 bg-brand-blue-500 text-[10px] font-black uppercase rounded-full tracking-widest">
                                    {{ $antrian->status }}
                                </span>
                            </div>

                            <div class="space-y-4 mb-10">
                                <div class="flex flex-col">
                                    <span class="text-[9px] text-white/30 uppercase font-black tracking-widest">Jadwal</span>
                                    <span class="text-sm font-bold">{{ date('d M Y', strtotime($antrian->tanggal_kunjungan)) }} | Sesi {{ $antrian->jam_kunjungan }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] text-white/30 uppercase font-black tracking-widest">Atas Nama</span>
                                    <span class="text-sm font-bold">{{ $antrian->nama_pengunjung }}</span>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-white/10 flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                                <span class="text-[10px] text-white/50 font-bold uppercase tracking-widest italic">Live tracking aktif</span>
                            </div>
                        </div>
                    </div>

                    <!-- Current Queue Status Card -->
                    <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-10 flex flex-col justify-center text-center">
                        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-8">Antrian Sekarang</h3>
                        
                        <div class="space-y-2 mb-10">
                            <div class="text-6xl font-mono font-black text-brand-blue-600 tracking-tighter">
                                {{-- Here we would ideally show the current serving number from AntrianService --}}
                                @php
                                    $current = \App\Models\Antrian::where('tanggal_kunjungan', date('Y-m-d'))
                                                ->where('status', 'dipanggil')
                                                ->orderBy('called_at', 'desc')
                                                ->first();
                                @endphp
                                {{ $current ? $current->nomor_antrian : '--' }}
                            </div>
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Sedang Dilayani Petugas</p>
                        </div>

                        <div class="bg-amber-50 rounded-2xl p-6 border border-amber-100 text-left">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="text-[10px] font-black text-amber-900 uppercase tracking-widest">Estimasi</span>
                            </div>
                            <p class="text-xs text-amber-800 leading-relaxed font-medium">
                                Silakan bersiap-siap jika nomor tiket Anda berselisih 2-3 angka dari antrian saat ini.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-12 text-center space-y-4 animate-in zoom-in-95 duration-500">
                    <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Token Tidak Valid</h2>
                    <p class="text-slate-500 text-sm max-w-sm mx-auto leading-relaxed">
                        Maaf, token akses yang Anda masukkan tidak terdaftar di sistem kami atau sudah kedaluwarsa.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('public.antrian.check') }}" class="text-brand-blue-600 font-bold text-xs uppercase tracking-widest hover:underline">Coba Lagi</a>
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>
@endsection
