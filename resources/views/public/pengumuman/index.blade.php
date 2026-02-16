@extends('layouts.public')

@section('title', 'Pengumuman - Desa Rambah Samo Barat')

@section('content')
<div class="bg-brand-blue-900 pt-32 pb-20 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4">Pengumuman Desa</h1>
        <p class="text-brand-blue-100 max-w-2xl mx-auto text-lg">Informasi penting dan pemberitahuan resmi dari Pemerintah Desa.</p>
    </div>
</div>

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($pengumuman->count() > 0)
            <div class="space-y-6">
                @foreach($pengumuman as $item)
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-shrink-0 flex flex-col items-center justify-center bg-slate-50 rounded-lg w-20 h-20 border border-slate-200">
                            <span class="text-2xl font-bold text-slate-700">{{ $item->created_at->format('d') }}</span>
                            <span class="text-xs uppercase font-bold text-slate-500">{{ $item->created_at->format('M Y') }}</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                @if($item->prioritas == 'tinggi')
                                    <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Penting</span>
                                @elseif($item->prioritas == 'sedang')
                                    <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Info</span>
                                @endif
                                <span class="text-xs text-slate-400">Diposting: {{ $item->created_at->diffForHumans() }}</span>
                            </div>
                            <h2 class="text-xl font-bold text-slate-900 mb-2 hover:text-brand-blue-600 transition-colors">
                                <a href="{{ route('public.pengumuman.show', $item->id) }}">{{ $item->judul }}</a>
                            </h2>
                            <div class="text-slate-600 line-clamp-2 mb-4">
                                {!! strip_tags($item->konten) !!}
                            </div>
                            <a href="{{ route('public.pengumuman.show', $item->id) }}" class="text-sm font-semibold text-brand-blue-600 hover:text-brand-blue-700 inline-flex items-center gap-1">
                                Baca Selengkapnya
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $pengumuman->links() }}
            </div>
        @else
            <div class="text-center py-24">
                 <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-6">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-slate-900">Belum ada pengumuman</h3>
                <p class="mt-1 text-slate-500">Saat ini belum ada pengumuman desa terbaru.</p>
            </div>
        @endif
    </div>
</div>
@endsection
