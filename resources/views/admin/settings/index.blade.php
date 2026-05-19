@extends('layouts.admin')

@section('title', 'Pengaturan - SID Desa Rambah Samo Barat')
@section('page_title', 'Pengaturan Website')

@section('content')
<div class="max-w-4xl mx-auto space-y-8" x-data="{ activeTab: 'village', themePrimary: '{{ \App\Models\Setting::get('theme_primary_color', '#0c89eb') }}', themeSecondary: '{{ \App\Models\Setting::get('theme_secondary_color', '#36b735') }}' }">
    <!-- Tab Navigation (Scrollable) -->
    <div class="overflow-x-auto pb-2 -mx-4 px-4 scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-transparent">
        <div class="flex items-center p-1.5 bg-slate-100 rounded-2xl w-max min-w-full gap-1">
            <button type="button"
                @click="activeTab = 'village'"
                :class="activeTab === 'village' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200/60' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50'"
                class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap flex items-center gap-2">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                Profil Desa
            </button>
            <button type="button"
                @click="activeTab = 'general'"
                :class="activeTab === 'general' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200/60' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50'"
                class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap flex items-center gap-2">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                Umum
            </button>
            <button type="button"
                @click="activeTab = 'contact'"
                :class="activeTab === 'contact' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200/60' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50'"
                class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap flex items-center gap-2">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                Kontak
            </button>
            <button type="button"
                @click="activeTab = 'social'"
                :class="activeTab === 'social' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200/60' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50'"
                class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap flex items-center gap-2">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.803a4 4 0 005.656 0l4-4a4 4 0 10-5.656-5.656l-1.1 1.1" /></svg>
                Sosial
            </button>
            <button type="button"
                @click="activeTab = 'theme'"
                :class="activeTab === 'theme' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200/60' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50'"
                class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap flex items-center gap-2">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
                Tema
            </button>
            <button type="button"
                @click="activeTab = 'home_content'"
                :class="activeTab === 'home_content' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200/60' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50'"
                class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap flex items-center gap-2">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                Beranda
            </button>
            <button type="button"
                @click="activeTab = 'menu'"
                :class="activeTab === 'menu' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200/60' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50'"
                class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap flex items-center gap-2">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                Menu
            </button>
        </div>
    </div>

    <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="village_identity" value="1">

        <!-- Village Identity Settings -->
        <div x-show="activeTab === 'village'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
            <div class="card p-8 border-slate-100">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </span>
                    Identitas Desa
                </h3>

                <div class="grid grid-cols-1 gap-8">
                    <!-- Logo & Nama Desa -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                        <div class="space-y-4">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Logo Desa (Opsional)</label>
                            <div class="flex items-center gap-6">
                                <div class="w-24 h-24 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden">
                                    @if(optional($village)->logo)
                                        <img src="{{ asset($village->logo) }}" class="w-full h-full object-contain">
                                    @else
                                        <svg class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="logo" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-brand-blue-50 file:text-brand-blue-700 hover:file:bg-brand-blue-100 transition-all cursor-pointer">
                                    <p class="mt-2 text-[10px] text-slate-400 font-medium">PNG, JPG atau WEBP. Rekomendasi 512x512px.</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Nama Desa / Judul Website</label>
                            <input type="text" name="nama_desa" value="{{ old('nama_desa', optional($village)->nama_desa) }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500" required>
                        </div>
                    </div>

                    <!-- Visi & Misi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Visi</label>
                            <textarea name="visi" rows="4" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">{{ old('visi', optional($village)->visi) }}</textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Misi</label>
                            <textarea name="misi" rows="4" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">{{ old('misi', optional($village)->misi) }}</textarea>
                        </div>
                    </div>

                    <!-- Sejarah -->
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Sejarah Desa</label>
                        <textarea name="sejarah" rows="6" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">{{ old('sejarah', optional($village)->sejarah) }}</textarea>
                    </div>

                    <!-- Struktur Organisasi -->
                    <div class="space-y-6" x-data="{ 
                        staff: {{ json_encode(optional($village)->struktur_organisasi ?? []) }},
                        init() {
                            if (this.staff.length === 0) {
                                this.staff = [
                                    { nama: '', jabatan: 'Kepala Desa', foto: null, is_core: true },
                                    { nama: '', jabatan: 'Sekretaris Desa', foto: null, is_core: true },
                                    { nama: '', jabatan: 'Bendahara Desa', foto: null, is_core: true }
                                ];
                            }
                        },
                        addStaff() {
                            this.staff.push({ nama: '', jabatan: '', foto: null, is_core: false });
                        },
                        removeStaff(index) {
                            if (this.staff[index].is_core) {
                                if (!confirm('Ini adalah jabatan inti. Apakah Anda yakin ingin menghapusnya?')) return;
                            }
                            this.staff.splice(index, 1);
                        }
                    }">
                        <div class="flex items-center justify-between">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Struktur Organisasi / Perangkat Desa</label>
                            <button type="button" @click="addStaff()" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-brand-blue-600 hover:text-brand-blue-700 transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                                Tambah Anggota
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <template x-for="(member, index) in staff" :key="index">
                                <div class="relative bg-white border border-slate-100 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all">
                                    <button type="button" @click="removeStaff(index)" class="absolute top-4 right-4 text-slate-400 hover:text-rose-500 transition-colors p-2 rounded-xl hover:bg-rose-50 group/delete" title="Hapus Anggota">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>

                                    <div class="flex gap-6 items-start">
                                        <div class="relative group/photo shrink-0">
                                            <div class="w-20 h-20 rounded-2xl bg-slate-50 border border-slate-100 overflow-hidden flex items-center justify-center">
                                                <template x-if="member.foto">
                                                    <img :src="member.foto.startsWith('http') || member.foto.startsWith('storage') ? '/' + member.foto : member.foto" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!member.foto">
                                                    <svg class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                </template>
                                            </div>
                                            <input type="file" :name="'staff_photos[' + index + ']'" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" @change="
                                                let file = $event.target.files[0];
                                                if (file) {
                                                    let reader = new FileReader();
                                                    reader.onload = (e) => { member.foto = e.target.result };
                                                    reader.readAsDataURL(file);
                                                }
                                            ">
                                            <input type="hidden" :name="'staff[' + index + '][old_photo]'" :value="member.foto && !member.foto.startsWith('data:') ? member.foto : ''">
                                        </div>

                                        <div class="flex-1 space-y-4">
                                            <div class="space-y-1">
                                                <label class="block text-[8px] font-black uppercase tracking-widest text-slate-400">Nama Lengkap</label>
                                                <input type="text" :name="'staff[' + index + '][nama]'" x-model="member.nama" class="w-full bg-slate-50 border-none rounded-xl text-sm font-bold p-3 focus:ring-2 focus:ring-brand-blue-500/20" placeholder="Contoh: Budi Santoso">
                                            </div>
                                            <div class="space-y-1">
                                                <label class="block text-[8px] font-black uppercase tracking-widest text-slate-400">Jabatan</label>
                                                <input type="text" :name="'staff[' + index + '][jabatan]'" x-model="member.jabatan" class="w-full bg-slate-50 border-none rounded-xl text-sm font-bold p-3 focus:ring-2 focus:ring-brand-blue-500/20" placeholder="Contoh: Sekretaris Desa">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <!-- Empty State Button -->
                            <div x-show="staff.length === 0" class="md:col-span-2 border-2 border-dashed border-slate-100 rounded-[2.5rem] p-12 text-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-900 mb-1">Belum ada struktur organisasi</h4>
                                <p class="text-xs text-slate-500 mb-6">Tambahkan anggota perangkat desa untuk ditampilkan di halaman profil.</p>
                                <button type="button" @click="addStaff()" class="btn-primary py-3 px-8 text-[10px]">
                                    Tambah Anggota Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- General Settings -->
        <div x-show="activeTab === 'general'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
            <div class="card p-8 border-slate-100">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </span>
                    Informasi Dasar
                </h3>

                <div class="grid grid-cols-1 gap-8">
                    @foreach($settings['general'] ?? [] as $setting)
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">{{ str_replace('_', ' ', $setting->key) }}</label>
                            @if($setting->type === 'textarea')
                                <textarea name="{{ $setting->key }}" rows="3" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">{{ $setting->value }}</textarea>
                            @else
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Copyright Footer -->
            <div class="card p-8 border-slate-100">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </span>
                    Hak Cipta (Copyright)
                </h3>
                <div class="space-y-3">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Teks Copyright Footer</label>
                    <input type="text" name="copyright_text" value="{{ \App\Models\Setting::get('copyright_text', '© ' . date('Y') . ' Desa Rambah Samo Barat. All Rights Reserved.') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                    <p class="text-[10px] text-slate-400 font-medium">Teks ini akan ditampilkan di bagian paling bawah (footer) halaman publik website.</p>
                </div>
            </div>
        </div>

        <!-- Contact Settings -->
        <div x-show="activeTab === 'contact'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
            <div class="card p-8 border-slate-100">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-brand-green-50 text-brand-green-600 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </span>
                    Informasi Kontak
                </h3>

                <div class="grid grid-cols-1 gap-8">
                    @foreach($settings['contact'] ?? [] as $setting)
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">{{ str_replace('_', ' ', $setting->key) }}</label>
                            @if($setting->type === 'textarea')
                                <textarea name="{{ $setting->key }}" rows="3" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">{{ $setting->value }}</textarea>
                            @else
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Social Media Settings -->
        <div x-show="activeTab === 'social'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
            <div class="card p-8 border-slate-100">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.803a4 4 0 005.656 0l4-4a4 4 0 10-5.656-5.656l-1.1 1.1" /></svg>
                    </span>
                    Tautan Media Sosial
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($settings['social'] ?? [] as $setting)
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">{{ str_replace('_', ' ', $setting->key) }}</label>
                            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500" placeholder="https://...">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Theme Settings -->
        <div x-show="activeTab === 'theme'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
            <div class="card p-8 border-slate-100">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
                    </span>
                    Tema Warna Halaman Publik
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <!-- Color Pickers -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Warna Utama (Primary Color)</label>
                            <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <div class="w-12 h-12 rounded-xl overflow-hidden border border-slate-200 shrink-0 relative">
                                    <input type="color" name="theme_primary_color" x-model="themePrimary" class="absolute inset-0 w-full h-full p-0 border-0 cursor-pointer scale-150">
                                </div>
                                <div class="flex-grow">
                                    <input type="text" x-model="themePrimary" class="w-full bg-transparent border-0 p-0 text-sm font-mono font-bold focus:ring-0 text-slate-700" placeholder="#000000" maxlength="7">
                                    <p class="text-[10px] text-slate-400 mt-1">Digunakan untuk latar belakang utama, tombol aksi, dan teks judul.</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Warna Sekunder (Secondary Color)</label>
                            <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <div class="w-12 h-12 rounded-xl overflow-hidden border border-slate-200 shrink-0 relative">
                                    <input type="color" name="theme_secondary_color" x-model="themeSecondary" class="absolute inset-0 w-full h-full p-0 border-0 cursor-pointer scale-150">
                                </div>
                                <div class="flex-grow">
                                    <input type="text" x-model="themeSecondary" class="w-full bg-transparent border-0 p-0 text-sm font-mono font-bold focus:ring-0 text-slate-700" placeholder="#000000" maxlength="7">
                                    <p class="text-[10px] text-slate-400 mt-1">Digunakan untuk aksen hijau/sekunder, lencana status, dan elemen dekoratif.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive Live Preview Card -->
                    <div class="bg-slate-900 rounded-[2rem] p-6 text-white border border-slate-800 shadow-2xl relative overflow-hidden flex flex-col gap-6">
                        <!-- Glassmorphism absolute background highlight -->
                        <div class="absolute -top-24 -right-24 w-48 h-48 rounded-full filter blur-[80px]" :style="'background-color: ' + themePrimary + '40'"></div>
                        <div class="absolute -bottom-24 -left-24 w-48 h-48 rounded-full filter blur-[80px]" :style="'background-color: ' + themeSecondary + '30'"></div>

                        <div class="relative z-10">
                            <span class="text-[8px] font-black uppercase tracking-widest text-slate-400">Live Preview Website</span>
                            <div class="mt-4 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 p-4">
                                <!-- Mock Navbar -->
                                <div class="flex justify-between items-center pb-3 border-b border-white/5">
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-5 h-5 rounded-full flex items-center justify-center text-[7px] font-bold" :style="'background-color: ' + themePrimary">D</div>
                                        <div class="flex flex-col text-[7px] leading-none font-bold">
                                            <span :style="'color: ' + themePrimary">DESA</span>
                                            <span class="text-[5px]" :style="'color: ' + themeSecondary">RAMBAH SAMO</span>
                                        </div>
                                    </div>
                                    <div class="flex gap-2 text-[7px] font-semibold text-slate-300">
                                        <span>Beranda</span>
                                        <span>Profil</span>
                                        <span>Berita</span>
                                    </div>
                                </div>

                                <!-- Mock Hero Area -->
                                <div class="py-6 text-center space-y-3">
                                    <span class="text-[7px] px-2 py-0.5 rounded-full inline-block font-extrabold uppercase tracking-wider" :style="'background-color: ' + themeSecondary + '20; color: ' + themeSecondary">
                                        Portal Resmi
                                    </span>
                                    <h4 class="text-xs font-black leading-tight tracking-tight">
                                        Selamat Datang di <br>
                                        <span :style="'color: ' + themePrimary">Desa Rambah Samo Barat</span>
                                    </h4>
                                    <p class="text-[7px] text-slate-400 max-w-[200px] mx-auto leading-relaxed">
                                        Mewujudkan tata kelola desa yang transparan, akuntabel, dan inovatif.
                                    </p>
                                    <div class="flex justify-center gap-2 pt-1">
                                        <button type="button" class="text-[7px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-lg text-white transition-all transform hover:scale-105" :style="'background-color: ' + themePrimary">
                                            Layanan Surat
                                        </button>
                                        <button type="button" class="text-[7px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-lg border text-white transition-all transform hover:scale-105" :style="'border-color: ' + themeSecondary + '50; background-color: ' + themeSecondary + '10'">
                                            Pengaduan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Publik Settings -->
        <div x-show="activeTab === 'menu'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
            <div class="card p-8 border-slate-100">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </span>
                    Kontrol Menu Halaman Publik
                </h3>

                <p class="text-xs text-slate-500 mb-8 font-medium leading-relaxed">
                    Gunakan tombol sakelar di bawah ini untuk menampilkan atau menyembunyikan menu/fitur tertentu pada halaman publik website desa.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Toggle 1: Profil Desa -->
                    <div class="flex items-center justify-between p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-slate-200 hover:bg-slate-100/50 transition-all">
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-xl bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Profil Desa</h4>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">Menampilkan menu Visi, Misi, Sejarah, & Struktur.</p>
                            </div>
                        </div>
                        <div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="hidden" name="menu_public_profil" value="0">
                                <input type="checkbox" name="menu_public_profil" value="1" {{ \App\Models\Setting::get('menu_public_profil', '1') === '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue-600"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Toggle 2: Berita -->
                    <div class="flex items-center justify-between p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-slate-200 hover:bg-slate-100/50 transition-all">
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-xl bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1M9 11h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Berita & Konten</h4>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">Menampilkan menu Berita, Pengumuman, & Agenda Desa.</p>
                            </div>
                        </div>
                        <div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="hidden" name="menu_public_berita" value="0">
                                <input type="checkbox" name="menu_public_berita" value="1" {{ \App\Models\Setting::get('menu_public_berita', '1') === '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue-600"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Toggle 3: Layanan Surat -->
                    <div class="flex items-center justify-between p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-slate-200 hover:bg-slate-100/50 transition-all">
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-xl bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Layanan Surat</h4>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">Menampilkan menu Permohonan Surat Online bagi warga.</p>
                            </div>
                        </div>
                        <div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="hidden" name="menu_public_surat" value="0">
                                <input type="checkbox" name="menu_public_surat" value="1" {{ \App\Models\Setting::get('menu_public_surat', '1') === '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue-600"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Toggle 4: Antrian -->
                    <div class="flex items-center justify-between p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-slate-200 hover:bg-slate-100/50 transition-all">
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-xl bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Antrian Online</h4>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">Menampilkan menu Pendaftaran Antrian Kantor Desa.</p>
                            </div>
                        </div>
                        <div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="hidden" name="menu_public_antrian" value="0">
                                <input type="checkbox" name="menu_public_antrian" value="1" {{ \App\Models\Setting::get('menu_public_antrian', '1') === '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue-600"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Toggle 5: Galeri -->
                    <div class="flex items-center justify-between p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-slate-200 hover:bg-slate-100/50 transition-all">
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-xl bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Galeri Foto</h4>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">Menampilkan menu Galeri Dokumentasi Foto Kegiatan Desa.</p>
                            </div>
                        </div>
                        <div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="hidden" name="menu_public_galeri" value="0">
                                <input type="checkbox" name="menu_public_galeri" value="1" {{ \App\Models\Setting::get('menu_public_galeri', '1') === '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue-600"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Toggle 6: Pengaduan -->
                    <div class="flex items-center justify-between p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-slate-200 hover:bg-slate-100/50 transition-all">
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-xl bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Pengaduan Warga</h4>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">Menampilkan menu Formulir Pengaduan dan Aspirasi Warga.</p>
                            </div>
                        </div>
                        <div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="hidden" name="menu_public_pengaduan" value="0">
                                <input type="checkbox" name="menu_public_pengaduan" value="1" {{ \App\Models\Setting::get('menu_public_pengaduan', '1') === '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue-600"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Toggle 7: Anggaran -->
                    <div class="flex items-center justify-between p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-slate-200 hover:bg-slate-100/50 transition-all">
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-xl bg-brand-blue-50 text-brand-blue-600 flex items-center justify-center shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Transparansi Anggaran</h4>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">Menampilkan menu informasi APBDes dan laporan keuangan.</p>
                            </div>
                        </div>
                        <div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="hidden" name="menu_public_anggaran" value="0">
                                <input type="checkbox" name="menu_public_anggaran" value="1" {{ \App\Models\Setting::get('menu_public_anggaran', '1') === '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue-600"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Beranda Settings -->
        <div x-show="activeTab === 'home_content'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">

            <!-- Info Banner -->
            <div class="flex items-start gap-4 p-5 bg-brand-blue-50 border border-brand-blue-100 rounded-2xl">
                <span class="w-10 h-10 rounded-xl bg-brand-blue-100 text-brand-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </span>
                <div>
                    <h4 class="text-xs font-bold text-brand-blue-800">Pengaturan Konten Halaman Beranda</h4>
                    <p class="text-[11px] text-brand-blue-600/80 mt-1 leading-relaxed">Kelola isi teks yang tampil di halaman depan website. Perubahan akan langsung terlihat oleh pengunjung setelah disimpan.</p>
                </div>
            </div>

            <!-- Kata Sambutan Kades -->
            <div class="card p-8 border-slate-100">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </span>
                    Kata Sambutan Kepala Desa
                </h3>

                <!-- Note -->
                <div class="flex items-start gap-3 p-4 bg-amber-50 border border-amber-100 rounded-xl mb-6">
                    <svg class="h-4 w-4 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg>
                    <p class="text-[11px] text-amber-700 font-medium leading-relaxed">Foto dan Nama Kepala Desa otomatis diambil dari <strong>"Struktur Organisasi"</strong> pada tab <strong>Profil Desa</strong> (Jabatan: "Kepala Desa").</p>
                </div>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Judul Sambutan</label>
                        <input type="text" name="sambutan_judul" value="{{ \App\Models\Setting::get('sambutan_judul', 'Sambutan Kepala Desa') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Kutipan Pembuka (Opsional)</label>
                        <input type="text" name="sambutan_kutipan" value="{{ \App\Models\Setting::get('sambutan_kutipan', '') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500" placeholder="Contoh: Bersama membangun desa yang lebih baik...">
                        <p class="text-[10px] text-slate-400 font-medium">Teks kutipan ini akan ditampilkan dengan format italic di atas isi sambutan.</p>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Isi Sambutan</label>
                        <textarea name="sambutan_isi" rows="8" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500" placeholder="Tulis isi sambutan kepala desa di sini...">{{ \App\Models\Setting::get('sambutan_isi', '') }}</textarea>
                        <p class="text-[10px] text-slate-400 font-medium">Gunakan baris baru (Enter) untuk memisahkan paragraf.</p>
                    </div>
                </div>
            </div>

            <!-- Tentang Desa -->
            <div class="card p-8 border-slate-100">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </span>
                    Konten "Tentang Desa"
                </h3>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Judul Singkat</label>
                        <input type="text" name="tentang_judul" value="{{ \App\Models\Setting::get('tentang_judul', 'Mengenal Desa Kami') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Deskripsi Singkat Tentang Desa</label>
                        <textarea name="tentang_deskripsi" rows="4" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500" placeholder="Ceritakan secara singkat tentang desa Anda...">{{ \App\Models\Setting::get('tentang_deskripsi', '') }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Keunggulan Desa (Pisahkan dengan koma)</label>
                        <input type="text" name="tentang_keunggulan" value="{{ \App\Models\Setting::get('tentang_keunggulan', 'Transparan, Mandiri, Inovatif') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold p-4 focus:ring-brand-blue-500 focus:border-brand-blue-500" placeholder="Contoh: Religius, Makmur, Sejahtera">
                        <p class="text-[10px] text-slate-400 font-medium">Setiap keunggulan akan ditampilkan sebagai item ceklis pada halaman beranda.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-brand-blue-600 hover:bg-brand-blue-700 text-white font-black uppercase tracking-widest text-xs py-4 px-10 rounded-2xl transition-all shadow-xl shadow-brand-blue-500/20 active:scale-95">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
