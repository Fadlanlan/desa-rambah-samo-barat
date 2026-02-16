@extends('layouts.public')

@section('title', 'Struktur Organisasi - ' . ($village->nama_desa ?? 'Desa Rambah Samo Barat'))

@section('content')
<div class="relative bg-slate-900 py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-500 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-brand-blue-400 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>
    </div>
    
    <div class="container relative z-10 mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-black text-white mb-4 uppercase tracking-tighter">Struktur Organisasi</h1>
        <p class="text-brand-blue-200 font-medium max-w-2xl mx-auto">
            Susunan elemen pemerintahan Desa Rambah Samo Barat yang siap melayani masyarakat.
        </p>
    </div>
</div>

<div class="container mx-auto px-6 -mt-10 relative z-20 pb-20">
    <div class="max-w-6xl mx-auto">
        <!-- Main Structure Card -->
        <div class="card p-8 md:p-12 bg-white shadow-2xl shadow-slate-200/50 rounded-[40px] border border-slate-100 mb-12">
            <div class="text-center mb-12">
                <h3 class="text-xs font-black text-brand-blue-600 uppercase tracking-[0.2em] mb-4">Bagan Pemerintahan</h3>
                <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tight">Hirarki Pelayanan Publik</h2>
            </div>

            @if($village->struktur_organisasi && is_array($village->struktur_organisasi) && count($village->struktur_organisasi) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($village->struktur_organisasi as $member)
                        <div class="card p-8 bg-white border border-slate-100 rounded-[32px] text-center shadow-lg hover:shadow-2xl transition-all group">
                            <div class="relative mb-6">
                                <div class="w-24 h-24 rounded-3xl bg-slate-50 mx-auto overflow-hidden border-2 border-slate-50 group-hover:border-brand-blue-100 transition-colors shadow-inner">
                                    @if(isset($member['foto']) && $member['foto'])
                                        <img src="{{ asset($member['foto']) }}" alt="{{ $member['nama'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 px-4 py-1 bg-brand-blue-600 text-white text-[8px] font-black uppercase tracking-widest rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                    Perangkat Desa
                                </div>
                            </div>
                            
                            <h4 class="text-lg font-black text-slate-800 leading-tight mb-1">{{ $member['nama'] ?? 'NAMA ANGGOTA' }}</h4>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-brand-blue-600">{{ $member['jabatan'] ?? 'JABATAN' }}</p>
                            
                            <div class="mt-6 flex justify-center">
                                <div class="w-10 h-1 bg-slate-100 rounded-full group-hover:bg-brand-blue-500 group-hover:w-16 transition-all"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif($village->struktur_organisasi && !is_array($village->struktur_organisasi))
                {{-- Fallback for old image-based structure --}}
                <div class="rounded-3xl overflow-hidden border-4 border-slate-50 shadow-inner group relative">
                    <img src="{{ asset('storage/' . $village->struktur_organisasi) }}" alt="Struktur Organisasi Resmi" class="w-full">
                    <div class="absolute inset-0 bg-brand-blue-900/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <a href="{{ asset('storage/' . $village->struktur_organisasi) }}" target="_blank" class="bg-white text-brand-blue-600 px-6 py-3 rounded-2xl font-black uppercase text-xs shadow-xl scale-95 group-hover:scale-100 transition-transform">Lihat Ukuran Penuh</a>
                    </div>
                </div>
            @else
                <div class="py-20 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight mb-2">Belum Ada Struktur Organisasi</h3>
                    <p class="text-sm text-slate-500 max-w-sm mx-auto">Data perangkat desa sedang dalam proses pembaharuan oleh admin.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
