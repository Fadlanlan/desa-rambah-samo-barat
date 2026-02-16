@extends('layouts.public')

@section('title', 'Ambil Antrian Online')

@section('content')
<section class="py-20 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Antrian <span class="text-brand-blue-600">Online</span></h1>
            <p class="text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Hindari antrian panjang di kantor desa. Booking jadwal kedatangan Anda secara online untuk layanan yang lebih cepat dan nyaman.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="bg-slate-900 px-8 py-6 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white uppercase tracking-tight">Formulir Booking Antrian</h2>
                    <p class="text-slate-400 text-xs mt-1 italic">Pilih jadwal yang tersedia untuk kunjungan Anda.</p>
                </div>
                <a href="{{ route('public.antrian.check') }}" class="text-brand-blue-400 hover:text-white text-xs font-bold uppercase tracking-widest border border-brand-blue-400/30 px-4 py-2 rounded-full transition-all">
                    Cek Status Antrian
                </a>
            </div>

            <form action="{{ route('public.antrian.store') }}" method="POST" class="p-8 md:p-10 space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="border-b border-slate-50 pb-2">
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-widest flex items-center gap-2">
                                <span class="w-2 h-2 bg-brand-blue-500 rounded-full"></span>
                                Data Pengunjung
                            </h4>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_pengunjung" value="{{ old('nama_pengunjung') }}" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" placeholder="Sesuai KTP..." required>
                                @error('nama_pengunjung') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">NIK (Opsional)</label>
                                <input type="text" name="nik_pengunjung" value="{{ old('nik_pengunjung') }}" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm font-mono focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" placeholder="16 digit NIK...">
                                @error('nik_pengunjung') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">No. WhatsApp</label>
                                <input type="text" name="kontak_pengunjung" value="{{ old('kontak_pengunjung') }}" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm font-mono focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" placeholder="0812..." required>
                                @error('kontak_pengunjung') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="border-b border-slate-50 pb-2">
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-widest flex items-center gap-2">
                                <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                                Jadwal & Keperluan
                            </h4>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Pilih Tanggal</label>
                                <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" required>
                                @error('tanggal_kunjungan') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Pilih Jam (Sesi)</label>
                                <select name="jam_kunjungan" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" required>
                                    <option value="">-- Pilih Sesi --</option>
                                    <option value="08:00" {{ old('jam_kunjungan') == '08:00' ? 'selected' : '' }}>Sesi 1 (08:00 - 09:00)</option>
                                    <option value="09:00" {{ old('jam_kunjungan') == '09:00' ? 'selected' : '' }}>Sesi 2 (09:00 - 10:00)</option>
                                    <option value="10:00" {{ old('jam_kunjungan') == '10:00' ? 'selected' : '' }}>Sesi 3 (10:00 - 11:00)</option>
                                    <option value="11:00" {{ old('jam_kunjungan') == '11:00' ? 'selected' : '' }}>Sesi 4 (11:00 - 12:00)</option>
                                </select>
                                @error('jam_kunjungan') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Keperluan Layanan</label>
                                <input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full px-4 py-3 bg-slate-50 border-slate-100 rounded-xl text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500 transition-all" placeholder="Contoh: Pengurusan SKU, KK, dsb..." required>
                                @error('keperluan') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-50 bg-slate-50/30 -mx-8 -mb-8 p-8 flex flex-col md:flex-row items-center justify-between gap-6">
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
                    <button type="submit" class="w-full md:w-auto bg-brand-blue-600 hover:bg-brand-blue-700 text-white font-black uppercase tracking-widest px-12 py-4 rounded-2xl shadow-lg shadow-brand-blue-100 transition-all hover:-translate-y-1 active:scale-95">
                        Ambil Nomor Antrian
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
