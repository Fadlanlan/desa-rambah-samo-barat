@extends('layouts.public')

@section('title', 'Visi & Misi - ' . ($village->nama_desa ?? 'Desa Rambah Samo Barat'))

@section('content')
<div class="relative bg-slate-900 py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-96 h-96 bg-brand-blue-500 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-brand-blue-400 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
    </div>
    
    <div class="container relative z-10 mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-black text-white mb-4 uppercase tracking-tighter">Visi & Misi</h1>
        <p class="text-brand-blue-200 font-medium max-w-2xl mx-auto">
            Arah kebijakan dan cita-cita luhur pembangunan Desa Rambah Samo Barat.
        </p>
    </div>
</div>

<div class="container mx-auto px-6 -mt-10 relative z-20 pb-20">
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Visi Card -->
        <div class="card p-10 md:p-16 bg-white shadow-2xl shadow-slate-200/50 rounded-[40px] border border-slate-100 text-center">
            <h3 class="text-xs font-black text-brand-blue-600 uppercase tracking-[0.2em] mb-8">Visi Utama Kami</h3>
            <div class="text-2xl md:text-3xl font-black text-slate-800 leading-tight italic">
                "{!! $village->visi ?? 'Mewujudkan Desa Rambah Samo Barat yang Maju, Sejahtera, dan Berakhlak Mulia melalui peningkatan kualitas layanan dan pemberdayaan masyarakat.' !!}"
            </div>
            <div class="mt-12 flex justify-center">
                <div class="w-16 h-1 bg-brand-blue-500 rounded-full opacity-20"></div>
            </div>
        </div>

        <!-- Misi Card -->
        <div class="card p-10 md:p-16 bg-white shadow-2xl shadow-slate-200/50 rounded-[40px] border border-slate-100">
            <h3 class="text-xs font-black text-brand-blue-600 uppercase tracking-[0.2em] mb-10 text-center">Misi Pembangunan</h3>
            <div class="grid grid-cols-1 gap-8 text-slate-600">
                @if($village->misi)
                    <div class="prose prose-slate max-w-none leading-relaxed text-lg">
                        {!! nl2br(e($village->misi)) !!}
                    </div>
                @else
                    <div class="space-y-6">
                        <div class="flex gap-6 items-start group">
                            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex-shrink-0 flex items-center justify-center text-brand-blue-600 font-black text-xl group-hover:bg-brand-blue-600 group-hover:text-white transition-all">01</div>
                            <p class="text-lg font-medium leading-relaxed pt-2">Meningkatkan kualitas sumber daya manusia melalui penguatan sektor pendidikan, kesehatan, dan keagamaan bagi seluruh lapisan masyarakat.</p>
                        </div>
                        <div class="flex gap-6 items-start group">
                            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex-shrink-0 flex items-center justify-center text-brand-blue-600 font-black text-xl group-hover:bg-brand-blue-600 group-hover:text-white transition-all">02</div>
                            <p class="text-lg font-medium leading-relaxed pt-2">Mendorong kemandirian ekonomi desa melalui optimalisasi potensi UMKM, pertanian, dan pemanfaatan teknologi informasi.</p>
                        </div>
                        <div class="flex gap-6 items-start group">
                            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex-shrink-0 flex items-center justify-center text-brand-blue-600 font-black text-xl group-hover:bg-brand-blue-600 group-hover:text-white transition-all">03</div>
                            <p class="text-lg font-medium leading-relaxed pt-2">Mewujudkan tata kelola pemerintahan desa yang bersih, transparan, dan akuntabel berbasis pelayanan digital yang prima.</p>
                        </div>
                        <div class="flex gap-6 items-start group">
                            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex-shrink-0 flex items-center justify-center text-brand-blue-600 font-black text-xl group-hover:bg-brand-blue-600 group-hover:text-white transition-all">04</div>
                            <p class="text-lg font-medium leading-relaxed pt-2">Memperkuat nilai-nilai gotong royong dan melestarikan kearifan lokal serta budaya masyarakat sebagai identitas desa.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
