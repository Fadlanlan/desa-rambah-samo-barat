@extends('layouts.admin')

@section('title', 'Daftar Pengaduan')
@section('page_title', 'Pengaduan Masyarakat')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-xl font-bold text-slate-800 tracking-tight uppercase">Daftar Tiket Aduan</h3>
        <div class="flex gap-2">
            <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}" class="px-3 py-1 text-xs font-semibold rounded-full {{ !request('status') ? 'bg-slate-800 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Semua</a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'baru']) }}" class="px-3 py-1 text-xs font-semibold rounded-full {{ request('status') == 'baru' ? 'bg-brand-blue-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Baru</a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'diproses']) }}" class="px-3 py-1 text-xs font-semibold rounded-full {{ request('status') == 'diproses' ? 'bg-amber-500 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Diproses</a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'selesai']) }}" class="px-3 py-1 text-xs font-semibold rounded-full {{ request('status') == 'selesai' ? 'bg-emerald-500 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Selesai</a>
        </div>
    </div>

    <!-- Filters -->
    <div class="card p-4">
        <form action="{{ route('pengaduan.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Tiket/Nama/Judul..." class="w-full pl-10 pr-4 py-2 border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                <svg class="absolute left-3 top-2.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <div>
                <select name="prioritas" class="w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                    <option value="">Semua Prioritas</option>
                    <option value="rendah" {{ request('prioritas') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="sedang" {{ request('prioritas') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="tinggi" {{ request('prioritas') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                    <option value="urgent" {{ request('prioritas') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>
            <div class="md:col-span-2 flex justify-end gap-2">
                <a href="{{ route('pengaduan.index') }}" class="btn-secondary py-2 px-6 bg-white !text-slate-500 border-slate-200">Reset</a>
                <button type="submit" class="btn-primary py-2 px-8">Filter</button>
            </div>
        </form>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-[10px] uppercase tracking-wider font-bold">
                    <tr>
                        <th class="px-6 py-4">Tiket / Tanggal</th>
                        <th class="px-6 py-4">Pelapor</th>
                        <th class="px-6 py-4">Judul Aduan</th>
                        <th class="px-6 py-4">Status / Prioritas</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @if(count($items) > 0)
                        @foreach ($items as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-mono text-xs text-brand-blue-600 font-bold uppercase truncate max-w-[150px]">
                                    {{ $item->nomor_tiket }}
                                </div>
                                <div class="text-[10px] text-slate-400 mt-0.5">{{ $item->created_at->format('d M Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">{{ $item->nama_pelapor }}</div>
                                <div class="text-[10px] text-slate-500 font-mono">{{ $item->kontak_pelapor }}</div>
                            </td>
                            <td class="px-6 py-4 max-w-xs">
                                <div class="text-sm text-slate-600 font-medium truncate">{{ $item->judul }}</div>
                                <div class="text-[10px] text-slate-400 uppercase tracking-tighter">{{ $item->kategori }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    <span class="w-fit px-2 py-0.5 rounded-full text-[9px] font-black uppercase {{ 
                                        $item->status == 'baru' ? 'bg-blue-100 text-blue-700' : (
                                        $item->status == 'diproses' ? 'bg-amber-100 text-amber-700' : (
                                        $item->status == 'selesai' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600')) 
                                    }}">
                                        {{ $item->status }}
                                    </span>
                                    <span class="text-[8px] font-bold uppercase {{
                                        $item->prioritas == 'urgent' ? 'text-red-600' : (
                                        $item->prioritas == 'tinggi' ? 'text-amber-600' : 'text-slate-400')
                                    }}">
                                        {{ $item->prioritas }} Priority
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @can('pengaduan.view')
                                <a href="{{ route('pengaduan.show', $item->id) }}" class="text-brand-blue-600 hover:text-brand-blue-800 font-bold text-xs uppercase tracking-wider">
                                    Kelola Aduan
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic text-sm">Tidak ada tiket aduan masuk.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if ($items->hasPages())
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
            {{ $items->links() }}
        </div>
        @endif
    </div>
    </div>

    {{-- Bersihkan Semua Aduan --}}
    @can('pengaduan.delete')
    @if($items->count() > 0)
    <div class="flex justify-end" x-data="{ showModal: false }">
        <button @click="showModal = true" type="button"
            class="text-xs font-bold text-red-500 hover:text-red-700 uppercase tracking-widest transition-colors flex items-center gap-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Bersihkan Semua Aduan
        </button>

        {{-- Modal Konfirmasi (Single) --}}
        <div x-show="showModal" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="fixed inset-0 bg-slate-900/60" @click="showModal = false"></div>
            <div class="relative bg-white rounded-xl shadow-2xl max-w-sm w-full p-6 z-10">
                <div class="text-center mb-6">
                    <div class="mx-auto p-3 bg-red-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Bersihkan Semua Aduan?</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Anda akan menghapus <span class="font-bold text-red-600">seluruh tiket pengaduan</span> dari sistem. Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="showModal = false" type="button" class="flex-1 py-2.5 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors uppercase tracking-wider">
                        Batal
                    </button>
                    <form action="{{ route('pengaduan.destroy-all') }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2.5 text-xs font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors uppercase tracking-wider shadow-lg shadow-red-500/30">
                            Ya, Bersihkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endcan
</div>
@endsection
