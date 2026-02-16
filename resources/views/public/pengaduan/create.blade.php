@extends('layouts.public')

@section('title', 'Layanan Pengaduan Masyarakat')

@section('content')
<section class="py-20 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Layanan Pengaduan <span class="text-brand-blue-600">Online</span></h1>
            <p class="text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Ada keluhan, saran, atau masalah di lingkungan desa? Sampaikan aspirasi Anda secara online. Kami akan menindaklanjuti setiap aduan dengan transparan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-brand-blue-50 text-brand-blue-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <h3 class="font-bold text-slate-800 mb-1">Tulis Aduan</h3>
                <p class="text-[11px] text-slate-500">Isi form di bawah dengan informasi yang lengkap dan valid.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bold text-slate-800 mb-1">Terima Tiket</h3>
                <p class="text-[11px] text-slate-500">Anda akan mendapatkan nomor tiket unik untuk melacak status.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <h3 class="font-bold text-slate-800 mb-1">Pantau Progress</h3>
                <p class="text-[11px] text-slate-500">Cek status penanganan melalui halaman tracking kami.</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="bg-slate-900 px-8 py-6 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white uppercase tracking-tight">Formulir Pengaduan</h2>
                    <p class="text-slate-400 text-xs mt-1 italic">Identitas pelapor akan dijaga kerahasiaannya.</p>
                </div>
                <a href="{{ route('public.pengaduan.check') }}" class="text-brand-blue-400 hover:text-white text-xs font-bold uppercase tracking-widest border border-brand-blue-400/30 px-4 py-2 rounded-full transition-all">
                    Cek Status Tiket
                </a>
            </div>

            <form action="{{ route('public.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="border-b border-slate-50 pb-2">
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-widest flex items-center gap-2">
                                <span class="w-2 h-2 bg-brand-blue-500 rounded-full"></span>
                                Identitas Pelapor
                            </h4>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" placeholder="Masukkan nama Anda..." required>
                                @error('nama_pelapor') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Kontak / WhatsApp</label>
                                <input type="text" name="kontak_pelapor" value="{{ old('kontak_pelapor') }}" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm font-mono focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" placeholder="Contoh: 08123456789" required>
                                @error('kontak_pelapor') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="border-b border-slate-50 pb-2">
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-widest flex items-center gap-2">
                                <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                                Detail Aduan
                            </h4>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Kategori Masalah</label>
                                <select name="kategori" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Infrastruktur" {{ old('kategori') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur (Jalan, Jembatan, dsb)</option>
                                    <option value="Layanan Publik" {{ old('kategori') == 'Layanan Publik' ? 'selected' : '' }}>Layanan Publik / Administrasi</option>
                                    <option value="Keamanan" {{ old('kategori') == 'Keamanan' ? 'selected' : '' }}>Keamanan & Ketertiban</option>
                                    <option value="Lingkungan" {{ old('kategori') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan Hidup / Kebersihan</option>
                                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('kategori') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Tingkat Prioritas</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <label class="relative flex items-center justify-center border-2 border-slate-50 rounded-xl p-3 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500 group">
                                        <input type="radio" name="prioritas" value="rendah" class="sr-only" {{ old('prioritas', 'sedang') == 'rendah' ? 'checked' : '' }}>
                                        <span class="text-xs font-bold text-slate-600 group-has-[:checked]:text-blue-700 uppercase">Rendah</span>
                                    </label>
                                    <label class="relative flex items-center justify-center border-2 border-slate-50 rounded-xl p-3 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:bg-amber-50 has-[:checked]:border-amber-500 group">
                                        <input type="radio" name="prioritas" value="sedang" class="sr-only" {{ old('prioritas', 'sedang') == 'sedang' ? 'checked' : '' }}>
                                        <span class="text-xs font-bold text-slate-600 group-has-[:checked]:text-amber-700 uppercase">Sedang</span>
                                    </label>
                                    <label class="relative flex items-center justify-center border-2 border-slate-50 rounded-xl p-3 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:bg-orange-50 has-[:checked]:border-orange-500 group">
                                        <input type="radio" name="prioritas" value="tinggi" class="sr-only" {{ old('prioritas', 'sedang') == 'tinggi' ? 'checked' : '' }}>
                                        <span class="text-xs font-bold text-slate-600 group-has-[:checked]:text-orange-700 uppercase">Tinggi</span>
                                    </label>
                                    <label class="relative flex items-center justify-center border-2 border-slate-50 rounded-xl p-3 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:bg-red-50 has-[:checked]:border-red-500 group">
                                        <input type="radio" name="prioritas" value="urgent" class="sr-only" {{ old('prioritas', 'sedang') == 'urgent' ? 'checked' : '' }}>
                                        <span class="text-xs font-bold text-slate-600 group-has-[:checked]:text-red-700 uppercase">Urgent</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Judul Laporan</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" placeholder="Tuliskan pokok persoalan..." required>
                        @error('judul') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Uraian / Isi Aduan</label>
                        <textarea name="isi" rows="6" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" placeholder="Ceritakan detail masalah, lokasi, dan kronologinya..." required>{{ old('isi') }}</textarea>
                        @error('isi') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Lampiran Bukti (Opsional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-200 border-dashed rounded-2xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest"><span class="text-brand-blue-600">Klik untuk upload</span> gambar bukti</p>
                                    <p class="text-[9px] text-slate-400 mt-1">PNG, JPG up to 2MB</p>
                                </div>
                                <input id="bukti_file" name="bukti_file" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @error('bukti_file') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-50 bg-slate-50/30 -mx-8 -mb-8 p-8 flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden">
                    <div class="flex items-center gap-4">
                        <div class="rounded-xl overflow-hidden border border-slate-200">
                            {!! captcha_img('math') !!}
                        </div>
                        <div>
                            <input type="text" name="captcha" class="w-24 px-3 py-2 border-slate-200 rounded-lg text-sm text-center font-bold focus:border-brand-blue-500 focus:ring-brand-blue-500" placeholder="Hasil?" required>
                            <p class="text-[9px] text-slate-400 mt-1 font-bold uppercase tracking-tight">Verifikasi Keamanan</p>
                        </div>
                        @error('captcha') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="w-full md:w-auto bg-brand-blue-600 hover:bg-brand-blue-700 text-white font-black uppercase tracking-widest px-12 py-4 rounded-2xl shadow-lg shadow-brand-blue-200 transition-all hover:-translate-y-1 active:scale-95">
                        Kirim Aduan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
