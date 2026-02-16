@extends('layouts.admin')

@section('title', 'Audit Log')
@section('page_title', 'Audit Log Sistem')

@section('content')
<div class="space-y-6">
    <!-- Filters -->
    <div class="card p-6 border-slate-100 bg-white shadow-sm rounded-2xl">
        <form action="{{ route('audit.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Tipe Log</label>
                <select name="log_name" class="w-full bg-slate-50 border-slate-100 rounded-xl text-xs font-bold py-3 px-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                    <option value="">-- Semua Tipe --</option>
                    <option value="default" {{ request('log_name') == 'default' ? 'selected' : '' }}>Sistem (Default)</option>
                    <option value="auth" {{ request('log_name') == 'auth' ? 'selected' : '' }}>Autentikasi</option>
                    <option value="warga" {{ request('log_name') == 'warga' ? 'selected' : '' }}>Kependudukan</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Kejadian (Event)</label>
                <select name="event" class="w-full bg-slate-50 border-slate-100 rounded-xl text-xs font-bold py-3 px-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                    <option value="">-- Semua Kejadian --</option>
                    <option value="created" {{ request('event') == 'created' ? 'selected' : '' }}>Dibuat (Created)</option>
                    <option value="updated" {{ request('event') == 'updated' ? 'selected' : '' }}>Diubah (Updated)</option>
                    <option value="deleted" {{ request('event') == 'deleted' ? 'selected' : '' }}>Dihapus (Deleted)</option>
                    <option value="login" {{ request('event') == 'login' ? 'selected' : '' }}>Login</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Pencarian</label>
                <input type="text" name="search" value="{{ request('search') }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-xs font-bold py-3 px-4 focus:ring-brand-blue-500 focus:border-brand-blue-500" placeholder="Deskripsi...">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-grow bg-slate-900 hover:bg-slate-800 text-white font-black uppercase tracking-widest text-[10px] py-3.5 rounded-xl transition-all shadow-lg active:scale-95">
                    Filter
                </button>
                <a href="{{ route('audit.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-black uppercase tracking-widest text-[10px] py-3.5 px-6 rounded-xl transition-all">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Log Table -->
    <div class="card overflow-hidden border-slate-50 shadow-sm rounded-3xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Aktor (Admin)</th>
                        <th class="px-6 py-4">Tipe & Event</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 text-right">Detail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @if(count($activities) > 0)
                        @foreach($activities as $activity)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-xs font-bold text-slate-800 block">{{ $activity->created_at->format('d/m/Y') }}</span>
                                    <span class="text-[10px] text-slate-400 font-mono tracking-tighter">{{ $activity->created_at->format('H:i:s') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($activity->causer)
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-brand-blue-100 text-brand-blue-600 flex items-center justify-center font-bold text-xs">
                                                {{ strtoupper(substr($activity->causer->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="text-xs font-bold text-slate-800 block leading-none mb-1">{{ $activity->causer->name }}</span>
                                                <span class="text-[9px] text-slate-400 font-medium leading-none uppercase tracking-widest italic">IP: {{ $activity->getExtraProperty('ip') ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-300 italic">Sistem Otomatis</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 bg-slate-900 text-white text-[9px] font-black uppercase rounded-md tracking-widest">
                                            {{ $activity->log_name }}
                                        </span>
                                        @php
                                            $eventColor = match($activity->event) {
                                                'created' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                'updated' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'deleted' => 'bg-red-50 text-red-600 border-red-100',
                                                'login' => 'bg-brand-blue-50 text-brand-blue-600 border-brand-blue-100',
                                                default => 'bg-slate-50 text-slate-600 border-slate-100'
                                            };
                                        @endphp
                                        <span class="px-2 py-0.5 border {{ $eventColor }} text-[9px] font-black uppercase rounded-md tracking-widest">
                                            {{ $activity->event ?? 'activity' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <p class="text-xs text-slate-600 font-medium leading-relaxed truncate">{{ $activity->description }}</p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @can('log.view')
                                    <button type="button" 
                                        class="text-brand-blue-500 hover:bg-brand-blue-50 px-3 py-1.5 rounded-lg transition-all"
                                        onclick="alert('Detail payload: ' + JSON.stringify({{ $activity->properties }}, null, 2))"
                                    >
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-xs italic font-medium tracking-wide border-2 border-dashed border-slate-50 rounded-b-3xl">
                                Belum ada riwayat aktivitas yang tercatat.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if($activities->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $activities->links() }}
            </div>
        @endif
    </div>

    {{-- Bersihkan Semua Log --}}
    @can('log.view')
    @if($activities->count() > 0)
    <div class="flex justify-end" x-data="{ showClearAuditModal: false }">
        <button @click="showClearAuditModal = true" type="button"
            class="text-xs font-bold text-red-500 hover:text-red-700 uppercase tracking-widest transition-colors flex items-center gap-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Bersihkan Semua Log
        </button>

        {{-- Modal Konfirmasi (Single) --}}
        <div x-show="showClearAuditModal" x-cloak style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="fixed inset-0 bg-slate-900/60" @click="showClearAuditModal = false"></div>
            <div class="relative bg-white rounded-xl shadow-2xl max-w-sm w-full p-6 z-10">
                <div class="text-center mb-6">
                    <div class="mx-auto p-3 bg-red-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Bersihkan Semua Log?</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Anda akan menghapus <span class="font-bold text-red-600">seluruh riwayat aktivitas</span> dari sistem. Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="showClearAuditModal = false" type="button" class="flex-1 py-2.5 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors uppercase tracking-wider">
                        Batal
                    </button>
                    <form action="{{ route('audit.destroy-all') }}" method="POST" class="flex-1">
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
