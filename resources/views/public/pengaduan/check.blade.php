@extends('layouts.public')

@section('title', 'Lacak Status Pengaduan')

@section('content')
<section class="py-20 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Lacak <span class="text-brand-blue-600">Aduan Anda</span></h1>
            <p class="text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Masukkan nomor tiket yang Anda terima untuk melihat status penanganan aduan secara real-time.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12 mb-12">
            <form action="{{ route('public.pengaduan.check') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow relative">
                    <input type="text" name="ticket" id="ticket" value="{{ $ticket }}" class="w-full pl-12 pr-4 py-4 bg-slate-50 border-slate-100 rounded-2xl text-lg font-mono font-bold uppercase tracking-widest focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" placeholder="TKT-XXXXXXXX-XXXX" required>
                    <svg class="absolute left-4 top-4.5 h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-black uppercase tracking-widest px-10 py-4 rounded-2xl transition-all shadow-lg active:scale-95">
                    Lacak Tiket
                </button>
            </form>
        </div>

        @if($ticket)
            @if($complaint)
                <div class="space-y-8 animate-in fade-in slide-in-from-bottom-5 duration-700">
                    <!-- Status Header -->
                    <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-1">Informasi Aduan</h3>
                                <div class="text-xl font-bold text-slate-900">{{ $complaint->judul }}</div>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest shadow-sm {{ 
                                    $complaint->status == 'baru' ? 'bg-blue-600 text-white' : (
                                    $complaint->status == 'diproses' ? 'bg-amber-500 text-white' : (
                                    $complaint->status == 'selesai' ? 'bg-emerald-600 text-white' : 'bg-slate-500 text-white')) 
                                }}">
                                    {{ $complaint->status }}
                                </span>
                                <span class="text-[10px] text-slate-400 mt-2">Update terakhir: {{ $complaint->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                                <div class="space-y-6">
                                    <div class="relative pl-8">
                                        <div class="absolute left-0 top-1 w-2 h-2 bg-brand-blue-500 rounded-full"></div>
                                        <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Isi Laporan</h4>
                                        <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $complaint->isi }}</p>
                                    </div>

                                    @if($complaint->bukti)
                                    <div class="relative pl-8">
                                        <div class="absolute left-0 top-1 w-2 h-2 bg-brand-blue-500 rounded-full"></div>
                                        <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Lampiran Bukti</h4>
                                        <div class="mt-2 rounded-xl border border-slate-100 p-1 bg-slate-50 shadow-inner inline-block">
                                            <img src="{{ Storage::url($complaint->bukti) }}" class="max-w-[200px] rounded-lg">
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="space-y-8">
                                    <!-- Progress Timeline -->
                                    <div class="space-y-6 relative before:absolute before:left-3 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100">
                                        <div class="relative pl-10">
                                            <div class="absolute left-0 top-0 w-6 h-6 rounded-full {{ $complaint->created_at ? 'bg-emerald-500 border-4 border-emerald-100' : 'bg-slate-200' }} z-10"></div>
                                            <h5 class="text-xs font-bold text-slate-800 uppercase tracking-tight">Aduan Dikirim</h5>
                                            <p class="text-[10px] text-slate-400">{{ $complaint->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                        <div class="relative pl-10">
                                            <div class="absolute left-0 top-0 w-6 h-6 rounded-full {{ $complaint->responded_at ? 'bg-emerald-500 border-4 border-emerald-100' : 'bg-slate-200' }} z-10"></div>
                                            <h5 class="text-xs font-bold text-slate-800 uppercase tracking-tight">Verifikasi & Proses</h5>
                                            <p class="text-[10px] text-slate-400">{{ $complaint->responded_at ? $complaint->responded_at->format('d M Y, H:i') : 'Menunggu antrian...' }}</p>
                                        </div>
                                        <div class="relative pl-10">
                                            <div class="absolute left-0 top-0 w-6 h-6 rounded-full {{ $complaint->status == 'selesai' ? 'bg-emerald-500 border-4 border-emerald-100' : 'bg-slate-200' }} z-10"></div>
                                            <h5 class="text-xs font-bold text-slate-800 uppercase tracking-tight">Selesai (Solusi)</h5>
                                            <p class="text-[10px] text-slate-400">{{ $complaint->resolved_at ? $complaint->resolved_at->format('d M Y, H:i') : 'Tahap akhir penyelesaian.' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Response Card -->
                        @if($complaint->balasan)
                        <div class="m-8 bg-brand-blue-50 border border-brand-blue-100 rounded-3xl p-8 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-brand-blue-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-brand-blue-200">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012-2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-brand-blue-900 uppercase tracking-widest">Tanggapan Resmi</h4>
                                    <p class="text-[10px] text-brand-blue-600 font-bold uppercase">Administrator Desa</p>
                                </div>
                            </div>
                            <div class="text-sm text-slate-700 leading-relaxed italic bg-white/60 p-6 rounded-2xl border border-white">
                                {!! nl2br(e($complaint->balasan)) !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-12 text-center space-y-4 animate-in zoom-in-95 duration-500">
                    <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Tiket Tidak Ditemukan</h2>
                    <p class="text-slate-500 text-sm max-w-sm mx-auto leading-relaxed">
                        Maaf, nomor tiket <strong>{{ $ticket }}</strong> tidak terdaftar di sistem kami. Mohon periksa kembali nomor tiket Anda.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('public.pengaduan.check') }}" class="text-brand-blue-600 font-bold text-xs uppercase tracking-widest hover:underline">Coba Lagi</a>
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>
@endsection
