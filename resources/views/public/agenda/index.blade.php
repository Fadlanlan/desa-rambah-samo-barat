@extends('layouts.public')

@section('title', 'Agenda Desa - Desa Rambah Samo Barat')

@section('content')
<div class="bg-brand-blue-900 pt-32 pb-20 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4">Agenda Kegiatan</h1>
        <p class="text-brand-blue-100 max-w-2xl mx-auto text-lg">Jadwal kegiatan dan acara penting di Desa Rambah Samo Barat.</p>
    </div>
</div>

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($agendas->count() > 0)
            <div class="space-y-6">
                @foreach($agendas as $agenda)
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-0 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col md:flex-row">
                    <div class="bg-brand-blue-600 text-white w-full md:w-32 flex flex-col items-center justify-center p-6 md:p-0 flex-shrink-0">
                        <span class="text-3xl font-black">{{ $agenda->tanggal_mulai->format('d') }}</span>
                        <span class="text-sm font-bold uppercase tracking-wider">{{ $agenda->tanggal_mulai->format('M Y') }}</span>
                    </div>
                    <div class="p-6 flex-1">
                        <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500 mb-3">
                            <span class="flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $agenda->tanggal_mulai->format('H:i') }} WIB
                            </span>
                            @if($agenda->lokasi)
                            <span class="flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $agenda->lokasi }}
                            </span>
                            @endif
                        </div>
                        
                        <h2 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-brand-blue-600 transition-colors">
                            <a href="{{ route('public.agenda.show', $agenda->id) }}">{{ $agenda->judul }}</a>
                        </h2>
                        
                        <p class="text-slate-600 mb-4 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($agenda->deskripsi), 150) }}</p>
                        
                        <div class="flex items-center justify-between border-t border-slate-50 pt-4">
                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Oleh: {{ $agenda->penyelenggara ?? 'Pemerintah Desa' }}
                            </span>
                            <a href="{{ route('public.agenda.show', $agenda->id) }}" class="text-sm font-bold text-brand-blue-600 hover:text-brand-blue-700">Detail Agenda &rarr;</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $agendas->links() }}
            </div>
        @else
            <div class="text-center py-24">
                 <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-6">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-slate-900">Belum ada agenda</h3>
                <p class="mt-1 text-slate-500">Jadwal kegiatan desa belum tersedia saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection
