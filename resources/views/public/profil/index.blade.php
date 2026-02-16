@extends('layouts.public')

@section('title', 'Profil Desa - ' . ($village->nama_desa ?? 'Desa Rambah Samo Barat'))

@section('content')
<div class="relative min-h-[400px] flex items-center justify-center overflow-hidden bg-slate-900">
    <div class="absolute inset-0 z-0 opacity-40">
        @if(isset($village) && $village->logo)
            <img src="{{ asset('storage/' . $village->logo) }}" alt="Village Background" class="w-full h-full object-cover blur-sm scale-110">
        @else
            <div class="w-full h-full bg-gradient-to-br from-brand-blue-900 to-brand-blue-700"></div>
        @endif
    </div>
    <div class="absolute inset-0 z-10 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>
    
    <div class="container relative z-20 mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-6xl font-black text-white mb-4 uppercase tracking-tighter">
            Profil {{ $village->nama_desa ?? 'Desa Rambah Samo Barat' }}
        </h1>
        <p class="text-lg md:text-xl text-brand-blue-200 font-medium max-w-2xl mx-auto">
            Mengenal lebih dekat sejarah, visi, misi, dan struktur pemerintahan desa kami demi pelayanan yang lebih baik.
        </p>
    </div>
</div>

<div class="container mx-auto px-6 -mt-20 relative z-30 pb-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-12">
            <!-- Visi & Misi -->
            <section class="card p-8 md:p-12 bg-white shadow-xl shadow-slate-200/50 rounded-3xl border border-slate-100">
                    <div class="flex items-center justify-between gap-4 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-brand-blue-500 flex items-center justify-center text-white shadow-lg shadow-brand-blue-200">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Visi & Misi</h2>
                        </div>
                        <a href="{{ route('public.profil.visi-misi') }}" class="text-xs font-black text-brand-blue-600 uppercase tracking-widest hover:text-brand-blue-800 transition-colors">Lihat Detail</a>
                    </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <h3 class="text-sm font-black text-brand-blue-600 uppercase tracking-widest mb-4">Visi Utama</h3>
                        <div class="text-slate-600 leading-relaxed italic text-lg border-l-4 border-brand-blue-200 pl-6 py-2">
                            {!! $village->visi ?? 'Mewujudkan Desa Rambah Samo Barat yang Maju, Sejahtera, dan Berakhlak Mulia melalui peningkatan kualitas layanan dan pemberdayaan masyarakat.' !!}
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-brand-blue-600 uppercase tracking-widest mb-4">Misi Desa</h3>
                        <div class="text-slate-600 leading-relaxed text-sm space-y-4">
                            @if($village->misi)
                                {!! nl2br(e($village->misi)) !!}
                            @else
                                <ul class="list-disc list-inside space-y-2">
                                    <li>Meningkatkan kualitas SDM melalui pendidikan dan kesehatan.</li>
                                    <li>Mendorong kemandirian ekonomi melalui UMKM dan Pertanian.</li>
                                    <li>Mewujudkan tata kelola pemerintahan yang transparan dan akuntabel.</li>
                                    <li>Memperkuat nilai-nilai agama dan budaya lokal.</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sejarah -->
            <section class="card p-8 md:p-12 bg-white shadow-xl shadow-slate-200/50 rounded-3xl border border-slate-100">
                    <div class="flex items-center justify-between gap-4 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-500 flex items-center justify-center text-white shadow-lg shadow-amber-200">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Sejarah Singkat</h2>
                        </div>
                        <a href="{{ route('public.profil.sejarah') }}" class="text-xs font-black text-amber-600 uppercase tracking-widest hover:text-amber-800 transition-colors">Baca Lengkap</a>
                    </div>
                
                <div class="text-slate-600 leading-relaxed prose prose-slate max-w-none">
                    @if($village->sejarah)
                        {!! nl2br(e($village->sejarah)) !!}
                    @else
                        <p class="mb-4">
                            Desa Rambah Samo Barat merupakan bagian dari wilayah administratif Kecamatan Rambah Samo yang memiliki latar belakang sejarah yang kaya akan nilai-nilai tradisional dan semangat gotong royong. Berawal dari pemukiman yang didukung oleh potensi alam yang subur...
                        </p>
                        <p>
                            Seiring berjalannya waktu, desa ini terus berkembang menjadi pusat kegiatan ekonomi dan sosial yang penting bagi masyarakat sekitarnya. (Konten sejarah lengkap akan diperbarui segera).
                        </p>
                    @endif
                </div>
            </section>

            <!-- Struktur Organisasi -->
            <section class="card p-8 md:p-12 bg-white shadow-xl shadow-slate-200/50 rounded-3xl border border-slate-100">
                    <div class="flex items-center justify-between gap-4 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500 flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Struktur Pemerintahan</h2>
                        </div>
                        <a href="{{ route('public.profil.struktur') }}" class="text-xs font-black text-emerald-600 uppercase tracking-widest hover:text-emerald-800 transition-colors">Lihat Bagan</a>
                    </div>

                @if($village->struktur_organisasi && is_array($village->struktur_organisasi) && count($village->struktur_organisasi) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach(array_slice($village->struktur_organisasi, 0, 3) as $member)
                            <div class="card p-6 bg-slate-50 border-slate-100 flex flex-col items-center text-center">
                                <div class="w-20 h-20 rounded-2xl bg-white mb-4 overflow-hidden border-2 border-slate-100 shadow-sm">
                                    @if(isset($member['foto']) && $member['foto'])
                                        <img src="{{ asset($member['foto']) }}" alt="{{ $member['nama'] }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-full h-full text-slate-300 p-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <h4 class="text-sm font-black text-slate-900 leading-tight">{{ $member['nama'] ?? 'NAMA' }}</h4>
                                <p class="text-[10px] font-black uppercase tracking-widest text-brand-blue-600 mt-1">{{ $member['jabatan'] ?? 'JABATAN' }}</p>
                            </div>
                        @endforeach
                    </div>
                @elseif($village->struktur_organisasi && !is_array($village->struktur_organisasi))
                    <div class="rounded-2xl overflow-hidden border border-slate-100">
                        <img src="{{ asset('storage/' . $village->struktur_organisasi) }}" alt="Struktur Organisasi" class="w-full">
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Kepala Desa Card -->
                        <div class="card p-6 bg-slate-50 border-slate-100 flex flex-col items-center text-center">
                            <div class="w-24 h-24 rounded-full bg-slate-200 mb-4 overflow-hidden border-4 border-white shadow-md">
                                <svg class="w-full h-full text-slate-400 p-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                </svg>
                            </div>
                            <h4 class="text-sm font-black text-slate-900">{{ $village->nama_kepala_desa ?? 'Nama Kepala Desa' }}</h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-brand-blue-600 mt-1">Kepala Desa</p>
                            @if($village->nip_kepala_desa)
                                <p class="text-[10px] text-slate-400 mt-1 font-mono">NIP: {{ $village->nip_kepala_desa }}</p>
                            @endif
                        </div>
                        
                        <!-- Placeholder for other members -->
                        <div class="card p-6 bg-slate-50 border-slate-100 flex flex-col items-center text-center opacity-70">
                            <div class="w-20 h-20 rounded-full bg-slate-200 mb-4 flex items-center justify-center">
                                <span class="text-xs font-black text-slate-400 uppercase">Sekdes</span>
                            </div>
                            <h4 class="text-xs font-bold text-slate-700 italic">Data Belum Tersedia</h4>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mt-1">Sekretaris Desa</p>
                        </div>

                        <div class="card p-6 bg-slate-50 border-slate-100 flex flex-col items-center text-center opacity-70">
                            <div class="w-20 h-20 rounded-full bg-slate-200 mb-4 flex items-center justify-center">
                                <span class="text-xs font-black text-slate-400 uppercase">Kaur</span>
                            </div>
                            <h4 class="text-xs font-bold text-slate-700 italic">Data Belum Tersedia</h4>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mt-1">Kepala Urusan</p>
                        </div>
                    </div>
                @endif
            </section>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-8">
            <!-- Village Logo/Identity -->
            <div class="card p-8 bg-brand-blue-600 text-white rounded-3xl shadow-xl shadow-brand-blue-200 text-center">
                @if(isset($village) && $village->logo)
                    <img src="{{ asset('storage/' . $village->logo) }}" alt="Logo Desa" class="w-24 h-24 mx-auto mb-6 drop-shadow-lg">
                @else
                    <div class="w-24 h-24 rounded-3xl bg-white/10 mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                @endif
                <h3 class="text-lg font-black uppercase tracking-widest mb-2">{{ $village->nama_desa ?? 'Desa Rambah Samo Barat' }}</h3>
                <p class="text-brand-blue-200 text-xs font-medium uppercase tracking-tighter">
                    Kec. {{ $village->kecamatan ?? 'Rambah Samo' }}, Kab. {{ $village->kabupaten ?? 'Rokan Hulu' }}
                </p>
                <div class="h-px bg-white/10 my-6"></div>
                <div class="flex justify-center gap-4">
                    <div class="p-2 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <div class="p-2 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Detailed Contact -->
            <div class="card p-6 bg-white border border-slate-100 rounded-3xl space-y-6">
                <h4 class="text-xs font-black uppercase tracking-widest text-slate-900 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-blue-500"></span>
                    Kontak Kantor
                </h4>
                
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="text-slate-400 mt-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Alamat</p>
                            <p class="text-xs text-slate-700 font-medium leading-relaxed">{{ $village->alamat_kantor ?? 'Jl. Utama Desa No. 01, Rambah Samo Barat' }}</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="text-slate-400 mt-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Telepon</p>
                            <p class="text-xs text-slate-700 font-medium">{{ $village->telepon ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="text-slate-400 mt-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Email</p>
                            <p class="text-xs text-slate-700 font-medium">{{ $village->email ?? 'desa@rambahsamobarat.id' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Barcode/Identity -->
            <div class="card p-6 bg-slate-50 border-slate-100 rounded-3xl text-center">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Kode Desa Resmi</p>
                <div class="text-2xl font-black text-slate-800 font-mono italic">{{ $village->kode_desa ?? '1406052001' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
