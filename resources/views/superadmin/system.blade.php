@extends('layouts.admin')

@section('title', 'Sistem & Monitoring - Super Admin')
@section('page_title', 'Pengaturan Sistem & Log')

@section('content')
<div class="space-y-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- System Settings -->
        <div class="lg:col-span-1 space-y-6">
            <div class="card p-8 bg-white border border-slate-100 shadow-sm relative overflow-hidden group">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </span>
                    Identitas Web
                </h3>
                
                <form action="{{ route('superadmin.system.updateSettings') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Nama Desa</label>
                        <input type="text" name="nama_desa" value="{{ $settings['nama_desa'] }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                    </div>

                    <div class="space-y-4">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Logo Desa</label>
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center overflow-hidden">
                                @if($settings['logo'])
                                    <img src="{{ asset($settings['logo']) }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="h-6 w-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                @endif
                            </div>
                            <input type="file" name="logo" class="text-[10px] text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-brand-blue-50 file:text-brand-blue-700 hover:file:bg-brand-blue-100 transition-all">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-brand-blue-600 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl hover:bg-brand-blue-700 transition-all shadow-xl shadow-brand-blue-500/20 active:scale-95">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            <div class="card p-8 bg-white border border-slate-100 shadow-sm">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                    </span>
                    Database Backup
                </h3>
                <p class="text-xs text-slate-500 mb-6 font-medium leading-relaxed">Pencadangan rutin sangat disarankan untuk menjaga keamanan data desa Anda.</p>
                <form action="{{ route('superadmin.system.backup') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-4 bg-slate-800 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl hover:bg-slate-900 transition-all shadow-xl shadow-slate-900/10 active:scale-95">
                        Buat Backup Sekarang
                    </button>
                </form>
            </div>
        </div>

        <!-- Activity Logs -->
        <div class="lg:col-span-2 space-y-6">
            <div class="card bg-white border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-50">
                    <h3 class="text-sm font-black uppercase tracking-widest text-slate-400">Seluruh Riwayat Aktivitas</h3>
                </div>
                <div class="divide-y divide-slate-50">
                    @foreach($activities as $log)
                        <div class="p-6 hover:bg-slate-50 transition-all flex gap-6 items-start">
                            <div class="w-12 h-12 rounded-2xl bg-white border border-slate-100 flex items-center justify-center shrink-0 shadow-sm font-bold text-slate-400">
                                {{ substr($log->causer->name ?? 'S', 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="text-sm font-black text-slate-800">{{ $log->description }}</p>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-2.5 py-1 bg-slate-100 rounded-lg">{{ $log->created_at->format('H:i') }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-brand-blue-600">{{ $log->causer->name ?? 'Sistem Utama' }}</span>
                                    <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                                    <span class="text-[10px] font-bold text-slate-400">{{ $log->created_at->format('d M Y') }}</span>
                                    @if(isset($log->properties['old']) || isset($log->properties['attributes']))
                                         <span class="text-[8px] bg-slate-50 px-1.5 py-0.5 rounded border border-slate-100 text-slate-400 font-black uppercase tracking-widest">Modified Data</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 text-center">
                    {{ $activities->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 immigrant view logic is slightly complex, so I'll keep it simple for now.
