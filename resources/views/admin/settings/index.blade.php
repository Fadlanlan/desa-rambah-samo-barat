@extends('layouts.admin')

@section('title', 'Pengaturan - SID Desa Rambah Samo Barat')
@section('page_title', 'Pengaturan Website')

@section('content')
<div class="max-w-4xl mx-auto space-y-8" x-data="{ activeTab: 'village' }">
    <!-- Tab Navigation -->
    <div class="flex items-center p-1 bg-slate-100 rounded-2xl w-fit">
        <button 
            @click="activeTab = 'village'"
            :class="activeTab === 'village' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
            class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
            Profil Desa
        </button>
        <button 
            @click="activeTab = 'general'"
            :class="activeTab === 'general' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
            class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all ml-1">
            Umum
        </button>
        <button 
            @click="activeTab = 'contact'"
            :class="activeTab === 'contact' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
            class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all ml-1">
            Kontak
        </button>
        <button 
            @click="activeTab = 'social'"
            :class="activeTab === 'social' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
            class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all ml-1">
            Media Sosial
        </button>
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
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
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

        <!-- Save Button -->
        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-brand-blue-600 hover:bg-brand-blue-700 text-white font-black uppercase tracking-widest text-xs py-4 px-10 rounded-2xl transition-all shadow-xl shadow-brand-blue-500/20 active:scale-95">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
