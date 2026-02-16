@extends('layouts.admin')

@section('title', 'Detail Pengaduan - ' . $item->nomor_tiket)
@section('page_title', 'Kelola Aduan Masyarakat')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('pengaduan.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors">
            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>

        <div class="flex gap-2">
            @if($item->status == 'baru')
            <form action="{{ route('pengaduan.process', $item->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-primary bg-amber-500 hover:bg-amber-600 border-none">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Proses Aduan
                </button>
            </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="card p-8">
                <div class="border-b border-slate-100 pb-4 mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Judul & Isi Aduan</span>
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase {{ 
                            $item->status == 'baru' ? 'bg-blue-100 text-blue-700' : (
                            $item->status == 'diproses' ? 'bg-amber-100 text-amber-700' : (
                            $item->status == 'selesai' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600')) 
                        }}">
                            {{ $item->status }}
                        </span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 leading-tight">{{ $item->judul }}</h2>
                </div>

                <div class="prose prose-slate max-w-none text-slate-600 text-sm leading-relaxed whitespace-pre-line">
                    {{ $item->isi }}
                </div>

                @if($item->bukti)
                <div class="mt-8 pt-6 border-t border-slate-100">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Bukti Pendukung</h4>
                    <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-50 p-2">
                        <img src="{{ Storage::url($item->bukti) }}" alt="Bukti Aduan" class="max-w-full rounded-lg shadow-sm">
                    </div>
                </div>
                @endif
            </div>

            <!-- Reply Section -->
            @if($item->status != 'selesai' && $item->status != 'ditolak')
            <div class="card p-8 border-t-4 border-brand-blue-500">
                <h3 class="text-lg font-bold text-slate-900 mb-6">Tanggapi / Beri Balasan</h3>
                <form action="{{ route('pengaduan.reply', $item->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <x-input-label for="balasan" :value="__('Isi Balasan Resmi')" />
                        <textarea id="balasan" name="balasan" rows="5" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500" placeholder="Tuliskan balasan atau solusi untuk aduan ini..." required>{{ old('balasan') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('balasan')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <x-input-label for="status" :value="__('Perbarui Status Menjadi')" />
                            <select id="status" name="status" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500" required>
                                <option value="selesai" selected>Selesai (Solusi Diberikan)</option>
                                <option value="ditolak">Tolak Aduan</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="btn-primary w-full py-2.5">Kirim Balasan & Tutup Tiket</button>
                        </div>
                    </div>
                </form>
            </div>
            @else
            <div class="card p-8 bg-emerald-50/50 border border-emerald-100">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="text-lg font-bold text-emerald-900">Aduan Telah Selesai</h3>
                </div>
                <div class="bg-white p-6 rounded-xl border border-emerald-100 shadow-sm">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Balasan Admin:</p>
                    <p class="text-sm text-slate-700 leading-relaxed italic">{{ $item->balasan }}</p>
                    <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                        <span class="text-[10px] text-slate-400">Dibalas oleh: <strong>{{ $item->handler->name ?? 'System' }}</strong></span>
                        <span class="text-[10px] text-slate-400">{{ $item->responded_at ? $item->responded_at->format('d M Y H:i') : '-' }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <div class="card p-6">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-tight mb-6 border-b border-slate-50 pb-2">Detail Pelapor</h4>
                <div class="space-y-4">
                    <div>
                        <div class="text-[10px] uppercase font-bold text-slate-400">Nama Pelapor</div>
                        <div class="text-sm font-medium text-slate-900">{{ $item->nama_pelapor }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] uppercase font-bold text-slate-400">Kontak / WhatsApp</div>
                        <div class="text-sm font-mono text-brand-blue-600 font-bold">{{ $item->kontak_pelapor }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] uppercase font-bold text-slate-400">Kategori</div>
                        <div class="text-sm font-medium text-slate-700">{{ $item->kategori }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] uppercase font-bold text-slate-400">Prioritas</div>
                        <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase {{
                            $item->prioritas == 'urgent' ? 'bg-red-600 text-white' : (
                            $item->prioritas == 'tinggi' ? 'bg-amber-500 text-white' : 'bg-slate-200 text-slate-600')
                        }}">
                            {{ $item->prioritas }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="card p-6 bg-slate-900 text-white">
                <h4 class="text-sm font-bold uppercase tracking-tight mb-4 border-b border-white/10 pb-2">Info Tiket</h4>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] text-white/50 uppercase">Nomor Tiket</span>
                        <span class="text-xs font-mono font-bold">{{ $item->nomor_tiket }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] text-white/50 uppercase">Tgl Masuk</span>
                        <span class="text-xs">{{ $item->created_at->format('d/m/Y') }}</span>
                    </div>
                    @if($item->resolved_at)
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] text-white/50 uppercase text-emerald-400">Tgl Selesai</span>
                        <span class="text-xs text-emerald-400">{{ $item->resolved_at->format('d/m/Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
