@extends('layouts.public')

@section('title', 'UMKM Desa - Desa Rambah Samo Barat')

@section('content')
<div class="bg-brand-blue-900 pt-32 pb-20 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4">UMKM Desa</h1>
        <p class="text-brand-blue-100 max-w-2xl mx-auto text-lg">Pusat informasi usaha mikro, kecil, dan menengah di Desa Rambah Samo Barat.</p>
    </div>
</div>

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($umkms->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($umkms as $umkm)
                <div class="group rounded-2xl border border-slate-100 bg-white p-4 shadow-sm transition hover:shadow-xl hover:-translate-y-1 duration-300 flex flex-col h-full">
                    <div class="aspect-video w-full overflow-hidden rounded-xl bg-slate-100 mb-6 relative">
                        @if($umkm->foto)
                        <img src="{{ asset('storage/' . $umkm->foto) }}" alt="{{ $umkm->nama_usaha }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                        @else
                        <div class="flex h-full w-full items-center justify-center text-slate-300">
                            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        @endif
                        
                        @if($umkm->kategori)
                        <div class="absolute top-3 left-3">
                             <span class="inline-flex items-center rounded-md bg-white/90 backdrop-blur px-2.5 py-1 text-xs font-bold text-slate-900 shadow-sm">
                                {{ $umkm->kategori }}
                            </span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="flex-1">
                        <h3 class="font-bold text-xl text-slate-900 mb-1 group-hover:text-brand-blue-600 transition-colors">{{ $umkm->nama_usaha }}</h3>
                        <p class="text-sm text-slate-500 mb-2">{{ $umkm->pemilik }}</p>
                        @if($umkm->deskripsi)
                        <p class="text-sm text-slate-600 line-clamp-3 mb-4">{{ $umkm->deskripsi }}</p>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-slate-50 mt-auto">
                         @if($umkm->no_hp)
                        <a href="https://wa.me/{{ $umkm->no_hp }}" target="_blank" class="text-sm font-semibold text-green-600 hover:text-green-700 flex items-center gap-2 bg-green-50 px-3 py-1.5 rounded-lg transition-colors w-full justify-center">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            Hubungi
                        </a>
                        @else
                        <span class="text-xs text-slate-400 font-medium w-full text-center py-1.5 bg-slate-100 rounded-lg">No Contact</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $umkms->links() }}
            </div>
        @else
            <div class="text-center py-24">
                <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-6">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-slate-900">Belum ada UMKM</h3>
                <p class="mt-1 text-slate-500">Data UMKM desa belum tersedia saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection
