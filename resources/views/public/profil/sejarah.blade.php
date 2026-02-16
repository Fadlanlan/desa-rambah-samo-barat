@extends('layouts.public')

@section('title', 'Sejarah Desa - ' . ($village->nama_desa ?? 'Desa Rambah Samo Barat'))

@section('content')
<div class="relative bg-slate-900 py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-30">
        @if(isset($village) && $village->logo)
            <img src="{{ asset('storage/' . $village->logo) }}" alt="Logo Background" class="w-1/2 h-full object-contain absolute right-[-10%] top-0 blur-sm opacity-20 rotate-12">
        @endif
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
    </div>
    
    <div class="container relative z-10 mx-auto px-6">
        <div class="max-w-2xl">
            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tighter leading-none">Jejak Langkah & Sejarah</h1>
            <div class="w-20 h-2 bg-brand-blue-500 rounded-full mb-6"></div>
            <p class="text-xl text-brand-blue-200 font-medium">
                Menelusuri asal-usul, perkembangan, dan warisan budaya Desa {{ $village->nama_desa ?? 'Rambah Samo Barat' }}.
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto px-6 -mt-16 relative z-20 pb-24">
    <div class="max-w-4xl mx-auto">
        <div class="card p-10 md:p-20 bg-white shadow-2xl shadow-slate-200/50 rounded-[40px] border border-slate-100">
            <div class="prose prose-slate prose-lg md:prose-xl max-w-none text-slate-600 leading-relaxed space-y-8">
                @if($village->sejarah)
                    {!! nl2br(e($village->sejarah)) !!}
                @else
                    <p class="first-letter:text-5xl first-letter:font-black first-letter:text-brand-blue-600 first-letter:mr-3 first-letter:float-left">
                        Desa Rambah Samo Barat berdiri sebagai sebuah komunitas yang menjunjung tinggi nilai-nilai tradisi Melayu dan kebersamaan. Terletak di jantung Kecamatan Rambah Samo, desa ini telah melewati berbagai fase sejarah yang membentuk jati diri masyarakatnya hingga saat ini.
                    </p>
                    
                    <h2 class="text-2xl font-black text-slate-800 !mt-12">Awal Mula Pendirian</h2>
                    <p>
                        Menurut penuturan para pemuka adat, wilayah ini pada awalnya merupakan kawasan hutan yang subur dengan potensi sumber daya alam yang melimpah. Para rombongan awal yang menetap di sini membukakan lahan untuk pertanian dan perkebunan, yang kemudian berkembang menjadi pemukiman yang teratur.
                    </p>

                    <div class="p-8 bg-slate-50 rounded-[32px] border-l-8 border-brand-blue-500 my-10 italic">
                        "Sejarah adalah cermin masa depan. Dengan memahami asal-usul, kita melangkah dengan pijakan yang lebih kokoh menuju kemajuan desa."
                    </div>

                    <h2 class="text-2xl font-black text-slate-800">Perkembangan Administratif</h2>
                    <p>
                        Secara resmi, pengakuan administratif Desa Rambah Samo Barat mengukuhkan posisi desa dalam sistem pemerintahan modern. Pembangunan infrastruktur jalan, fasilitas umum, dan pusat pelayanan masyarakat mulai digiatkan untuk mendukung percepatan ekonomi warga.
                    </p>

                    <p>
                        Kini, Desa Rambah Samo Barat berkomitmen untuk terus berinovasi dalam pelayanan publik dengan tetap menjaga kelestarian sejarah dan adat istiadat yang telah diwariskan secara turun-temurun.
                    </p>
                @endif
            </div>

            <div class="mt-20 flex flex-wrap gap-4 items-center justify-between border-t border-slate-50 pt-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-900 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-black tracking-widest text-slate-400">Terakhir Diperbarui</p>
                        <p class="text-xs font-bold text-slate-700">{{ $village->updated_at ? $village->updated_at->format('d M Y') : '14 Feb 2026' }}</p>
                    </div>
                </div>
                
                <div class="flex gap-2">
                    <span class="px-3 py-1 bg-brand-blue-50 text-brand-blue-600 text-[10px] font-black uppercase rounded-full">Budaya</span>
                    <span class="px-3 py-1 bg-brand-blue-50 text-brand-blue-600 text-[10px] font-black uppercase rounded-full">Tradisi</span>
                    <span class="px-3 py-1 bg-brand-blue-50 text-brand-blue-600 text-[10px] font-black uppercase rounded-full">Sejarah</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
