@extends('layouts.admin')

@section('title', 'Super Admin Dashboard - Desa Rambah Samo Barat')
@section('page_title', 'Super Admin Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card p-8 border-slate-100 bg-white shadow-sm overflow-hidden relative group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-20 h-20 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Total Pengguna</p>
            <h3 class="text-4xl font-black text-slate-800">{{ $stats['total_users'] }}</h3>
            <p class="text-xs text-slate-500 mt-2 font-bold">{{ $stats['total_admins'] }} Administrator terdaftar</p>
        </div>

        <div class="card p-8 border-slate-100 bg-white shadow-sm overflow-hidden relative group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-20 h-20 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Status Kunci Admin</p>
            <h3 class="text-4xl font-black {{ $stats['lock_status']['admin'] ? 'text-rose-600' : 'text-emerald-600' }}">
                {{ $stats['lock_status']['admin'] ? 'TERKUNCI' : 'AKTIF' }}
            </h3>
            <p class="text-xs text-slate-500 mt-2 font-bold">Akses Dashboard Admin</p>
        </div>

        <div class="card p-8 border-slate-100 bg-white shadow-sm overflow-hidden relative group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-20 h-20 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Status Kunci User</p>
            <h3 class="text-4xl font-black {{ $stats['lock_status']['user'] ? 'text-rose-600' : 'text-emerald-600' }}">
                {{ $stats['lock_status']['user'] ? 'TERKUNCI' : 'AKTIF' }}
            </h3>
            <p class="text-xs text-slate-500 mt-2 font-bold">Akses Layanan Publik</p>
        </div>
    </div>

    <!-- System Actions & Logs -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="card border-slate-100 bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400">Kontrol Cepat Sistem</h3>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <form action="{{ url('superadmin/lock/admin') }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="{{ $stats['lock_status']['admin'] ? '0' : '1' }}">
                    <button type="submit" class="w-full flex items-center justify-between p-4 rounded-2xl border {{ $stats['lock_status']['admin'] ? 'border-emerald-100 bg-emerald-50 text-emerald-700' : 'border-rose-100 bg-rose-50 text-rose-700' }} group transition-all">
                        <span class="font-bold text-sm">{{ $stats['lock_status']['admin'] ? 'Buka Kunci Admin' : 'Kunci Admin' }}</span>
                        <svg class="h-5 w-5 opacity-50 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </button>
                </form>

                <form action="{{ url('superadmin/lock/user') }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="{{ $stats['lock_status']['user'] ? '0' : '1' }}">
                    <button type="submit" class="w-full flex items-center justify-between p-4 rounded-2xl border {{ $stats['lock_status']['user'] ? 'border-emerald-100 bg-emerald-50 text-emerald-700' : 'border-rose-100 bg-rose-50 text-rose-700' }} group transition-all">
                        <span class="font-bold text-sm">{{ $stats['lock_status']['user'] ? 'Buka Kunci User' : 'Kunci User' }}</span>
                        <svg class="h-5 w-5 opacity-50 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="card border-slate-100 bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-50">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400">Log Aktivitas Terbaru</h3>
            </div>
            <div class="divide-y divide-slate-50">
                @if(count($stats['recent_activities'] ?? []) > 0)
                    @foreach($stats['recent_activities'] as $activity)
                        <div class="p-4 flex gap-4 items-start hover:bg-slate-50 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center shrink-0">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-800">{{ $activity->description }}</p>
                                <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black mt-0.5">
                                    {{ $activity->causer->name ?? 'System' }} • {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-10 text-center">
                        <p class="text-sm text-slate-400 font-medium italic">Tidak ada aktivitas baru.</p>
                    </div>
                @endif
            </div>
            <div class="p-4 bg-slate-50 border-t border-slate-100 text-center">
                <a href="{{ route('superadmin.system') }}" class="text-[10px] font-black uppercase tracking-widest text-brand-blue-600 hover:text-brand-blue-700 transition-colors">Lihat Semua Log</a>
            </div>
        </div>
    </div>
</div>
@endsection
