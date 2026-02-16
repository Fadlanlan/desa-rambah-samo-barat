@extends('layouts.admin')

@section('title', 'Ubah Berita - ' . $berita->judul)
@section('page_title', 'Edit Artikel')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <a href="{{ route('berita.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>

    <div class="card p-8">
        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="space-y-2">
                        <x-input-label for="judul" :value="__('Judul Artikel')" />
                        <x-text-input id="judul" name="judul" type="text" class="block w-full text-lg font-bold" :value="old('judul', $berita->judul)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('judul')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="ringkasan" :value="__('Ringkasan / Sinopsis')" />
                        <textarea id="ringkasan" name="ringkasan" rows="3" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('ringkasan')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="konten" :value="__('Isi Berita')" />
                        <textarea id="konten" name="konten" rows="15" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500 font-serif" required>{{ old('konten', $berita->konten) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('konten')" />
                    </div>
                </div>

                <!-- Sidebar Settings -->
                <div class="space-y-6">
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 space-y-6">
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-slate-200 pb-2">Pengaturan</h4>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <x-input-label for="category_id" :value="__('Kategori')" />
                                <select id="category_id" name="category_id" class="block w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $berita->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                            </div>

                            <div class="space-y-3 pt-2">
                                <label class="flex items-center cursor-pointer group">
                                    <div class="relative">
                                        <input type="checkbox" name="is_published" value="1" class="sr-only peer" {{ old('is_published', $berita->is_published) ? 'checked' : '' }}>
                                        <div class="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:bg-emerald-500 transition-colors"></div>
                                        <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full peer-checked:translate-x-5 transition-transform"></div>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-slate-700 group-hover:text-slate-900">Terbitkan</span>
                                </label>

                                <label class="flex items-center cursor-pointer group">
                                    <div class="relative">
                                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', $berita->is_featured) ? 'checked' : '' }}>
                                        <div class="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:bg-amber-500 transition-colors"></div>
                                        <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full peer-checked:translate-x-5 transition-transform"></div>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-slate-700 group-hover:text-slate-900">Unggulan</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 space-y-4">
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-slate-200 pb-2">Gambar Utama</h4>
                        
                        @if($berita->gambar)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-full h-32 object-cover rounded-xl border border-slate-200" alt="">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                <p class="text-[10px] text-white font-bold uppercase">Ganti Gambar</p>
                            </div>
                        </div>
                        @endif

                        <div class="space-y-3">
                            <div class="border-2 border-dashed border-slate-200 rounded-xl p-4 text-center hover:border-brand-blue-400 transition-colors">
                                <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*">
                                <label for="gambar" class="cursor-pointer space-y-2 block">
                                    <svg class="h-8 w-8 text-slate-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-tight">Pilih gambar file baru</p>
                                </label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('gambar')" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-8 border-t border-slate-100 flex justify-between gap-3">
                <button type="submit" form="delete-form" class="text-sm font-bold text-red-500 hover:text-red-700 uppercase tracking-widest transition-colors" onclick="return confirm('Hapus berita ini?')">
                    Hapus Berita
                </button>
                <div class="flex gap-3">
                    <a href="{{ route('berita.index') }}" class="btn-secondary py-3 px-8 bg-white border-slate-200">
                        Batal
                    </a>
                    <button type="submit" class="btn-primary py-3 px-12">
                        Update Berita
                    </button>
                </div>
            </div>
        </form>

        <form id="delete-form" action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection
