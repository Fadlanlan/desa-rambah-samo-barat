@extends('layouts.admin')
@section('title', 'Tambah Pembangunan')
@section('page_title', 'Tambah Laporan Pembangunan')
@section('content')
<div class="card p-8 max-w-4xl mx-auto">
    <div class="mb-8">
        <h2 class="text-xl font-black text-slate-800">Form Laporan Proyek Pembangunan Fisik</h2>
        <p class="text-xs font-medium text-slate-500">Lengkapi data di bawah ini untuk ditayangkan ke halaman transparansi publik.</p>
    </div>

    @if($errors->any())
        <div class="bg-rose-50 text-rose-600 p-4 rounded-xl mb-6 text-sm font-bold">
            Terdapat kesalahan input data. Harap periksa kembali.
        </div>
    @endif

    <form action="{{ route('pembangunan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Nama Proyek / Kegiatan</label>
                <input type="text" name="nama" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" required>
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Tahun Anggaran</label>
                <input type="number" name="tahun" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" value="{{ date('Y') }}" required>
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Kategori Pekerjaan</label>
                <select name="kategori" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" required>
                    <option value="Jalan">Infrastruktur Jalan</option>
                    <option value="Jembatan">Infrastruktur Jembatan</option>
                    <option value="Irigasi">Irigasi & Drainase</option>
                    <option value="Gedung">Gedung / Bangunan</option>
                    <option value="Sosial">Fasilitas Sosial / Lainnya</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Status</label>
                    <select name="status" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" required>
                        <option value="Perencanaan">Perencanaan</option>
                        <option value="Berjalan">Sedang Berjalan</option>
                        <option value="Selesai">Selesai 100%</option>
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Progres (%)</label>
                    <input type="number" name="progress" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" value="0" min="0" max="100" required>
                </div>
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Penanggung Jawab (Tim Pelaksana)</label>
                <input type="text" name="pj" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500">
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Sumber Dana</label>
                <input type="text" name="sumber_dana" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" placeholder="Contoh: Dana Desa (DD)">
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Anggaran (Rp)</label>
                <input type="number" name="anggaran" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" value="0" required>
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Realisasi (Rp)</label>
                <input type="number" name="realisasi" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" value="0" required>
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Lokasi / Dusun</label>
                <input type="text" name="lokasi" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" placeholder="Contoh: Dusun I RT 02 / RW 01">
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Titik Koordinat Lapangan</label>
                <input type="text" name="lat_long" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" placeholder="-0.8550, 100.3134">
            </div>
        </div>
        
        <div class="space-y-1">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Deskripsi Lengkap Kegiatan</label>
            <textarea name="deskripsi" rows="3" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500"></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Foto Sebelum Pengerjaan</label>
                <input type="file" name="foto_sebelum" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-brand-blue-50 file:text-brand-blue-700 hover:file:bg-brand-blue-100" accept="image/*">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Foto Sesudah Pengerjaan</label>
                <input type="file" name="foto_sesudah" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" accept="image/*">
            </div>
        </div>

        <div class="pt-4 flex justify-end gap-3">
            <a href="{{ route('pembangunan.index') }}" class="px-6 py-3 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-100">Batal</a>
            <button type="submit" class="btn-primary">Simpan Laporan Pembangunan</button>
        </div>
    </form>
</div>
@endsection
