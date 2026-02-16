@extends('layouts.admin')

@section('title', 'Manajemen Pengguna - Super Admin')
@section('page_title', 'Manajemen Pengguna')

@section('content')
<div class="space-y-8" x-data="{ showAddModal: false, showEditModal: false, editingUser: null }">
    <!-- Header Actions -->
    <div class="flex items-center justify-between bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div>
            <h3 class="text-sm font-black uppercase tracking-widest text-slate-400">Total Daftar Pengguna</h3>
            <p class="text-2xl font-black text-slate-800">{{ $users->total() }} Akun</p>
        </div>
        <button @click="showAddModal = true" class="flex items-center gap-3 px-6 py-4 bg-brand-blue-600 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl hover:bg-brand-blue-700 transition-all shadow-xl shadow-brand-blue-500/20 active:scale-95">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
            Tambah Pengguna Baru
        </button>
    </div>

    <!-- Users Table -->
    <div class="card border-slate-100 bg-white shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Pengguna</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Role</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($users as $user)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center font-bold text-slate-500 border border-slate-200 uppercase">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-800 leading-none">{{ $user->name }}</p>
                                        <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @foreach($user->roles as $role)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $role->name === 'super-admin' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-brand-blue-50 text-brand-blue-700 border border-brand-blue-100' }}">
                                        {{ str_replace('-', ' ', $role->name) }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $user->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-red-50 text-red-700 border border-red-100' }}">
                                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 w-48">
                                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button @click="showEditModal = true; editingUser = {{ $user }}" class="p-2 bg-white border border-slate-100 text-slate-400 hover:text-brand-blue-600 hover:border-brand-blue-100 rounded-xl transition-all shadow-sm" title="Edit User">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </button>
                                    <form action="{{ route('superadmin.user.toggleStatus', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 border border-slate-100 text-slate-400 {{ $user->is_active ? 'hover:text-rose-500 hover:bg-rose-50 hover:border-rose-100' : 'hover:text-emerald-500 hover:bg-emerald-50 hover:border-emerald-100' }} rounded-xl transition-all shadow-sm" title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('superadmin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-white border border-slate-100 text-slate-400 hover:text-red-500 hover:border-red-100 rounded-xl transition-all shadow-sm" title="Hapus User">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modals (Simplified approach with Alpine) -->
    <template x-if="showAddModal">
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-6">
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showAddModal = false"></div>
            <div class="relative bg-white max-w-lg w-full rounded-3xl overflow-hidden shadow-2xl">
                <form action="{{ route('superadmin.user.store') }}" method="POST" class="p-8">
                    @csrf
                    <div class="mb-8">
                        <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Tambah Pengguna</h3>
                        <p class="text-slate-500 text-xs font-bold">Masukkan informasi akun admin baru desa.</p>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Nama Lengkap</label>
                            <input type="text" name="name" required class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Email Resmi</label>
                            <input type="email" name="email" required class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Password Awal</label>
                            <input type="password" name="password" required class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Akses Role</label>
                            <select name="role" required class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                                <option value="admin">Admin Desa</option>
                                <option value="super-admin">Super Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button type="button" @click="showAddModal = false" class="flex-1 px-6 py-4 bg-slate-100 text-slate-500 font-extrabold uppercase tracking-widest text-[10px] rounded-2xl hover:bg-slate-200 transition-all">Batal</button>
                        <button type="submit" class="flex-1 px-6 py-4 bg-brand-blue-600 text-white font-extrabold uppercase tracking-widest text-[10px] rounded-2xl hover:bg-brand-blue-700 transition-all">Simpan Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection
