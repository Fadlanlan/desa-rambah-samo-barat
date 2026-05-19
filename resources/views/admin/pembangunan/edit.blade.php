@extends('layouts.admin')
@section('title', 'Edit Pembangunan')
@section('page_title', 'Edit Laporan Pembangunan')
@section('content')
<div class="card p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex justify-between items-start">
        <div>
            <h2 class="text-xl font-black text-slate-800">Edit Data Pembangunan</h2>
            <p class="text-xs font-medium text-slate-500">Perbarui data atau progress pelaksanaan fisik secara realtime.</p>
        </div>
        <span class="px-3 py-1 rounded-full bg-brand-blue-50 text-brand-blue-700 text-xs font-bold uppercase tracking-wider">
            Progres: {{ $pembangunan->progress }}%
        </span>
    </div>

    @if($errors->any())
        <div class="bg-rose-50 text-rose-600 p-4 rounded-xl mb-6 text-sm font-bold">
            Terdapat kesalahan input data. Harap periksa kembali.
        </div>
    @endif

    <form action="{{ route('pembangunan.update', $pembangunan) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Nama Proyek / Kegiatan</label>
                <input type="text" name="nama" value="{{ old('nama', $pembangunan->nama) }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" required>
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Tahun Anggaran</label>
                <input type="number" name="tahun" value="{{ old('tahun', $pembangunan->tahun) }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" required>
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Kategori Pekerjaan</label>
                <select name="kategori" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" required>
                    <option value="Jalan" {{ $pembangunan->kategori == 'Jalan' ? 'selected' : '' }}>Infrastruktur Jalan</option>
                    <option value="Jembatan" {{ $pembangunan->kategori == 'Jembatan' ? 'selected' : '' }}>Infrastruktur Jembatan</option>
                    <option value="Irigasi" {{ $pembangunan->kategori == 'Irigasi' ? 'selected' : '' }}>Irigasi & Drainase</option>
                    <option value="Gedung" {{ $pembangunan->kategori == 'Gedung' ? 'selected' : '' }}>Gedung / Bangunan</option>
                    <option value="Sosial" {{ $pembangunan->kategori == 'Sosial' ? 'selected' : '' }}>Fasilitas Sosial / Lainnya</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Status</label>
                    <select name="status" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" required>
                        <option value="Perencanaan" {{ $pembangunan->status == 'Perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                        <option value="Berjalan" {{ $pembangunan->status == 'Berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                        <option value="Selesai" {{ $pembangunan->status == 'Selesai' ? 'selected' : '' }}>Selesai 100%</option>
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Progres (%)</label>
                    <input type="number" name="progress" value="{{ old('progress', $pembangunan->progress) }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" min="0" max="100" required>
                </div>
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Penanggung Jawab (Tim Pelaksana)</label>
                <input type="text" name="pj" value="{{ old('pj', $pembangunan->pj) }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500">
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Sumber Dana</label>
                <input type="text" name="sumber_dana" value="{{ old('sumber_dana', $pembangunan->sumber_dana) }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500">
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Anggaran (Rp)</label>
                <input type="number" name="anggaran" value="{{ old('anggaran', $pembangunan->anggaran) }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" required>
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Realisasi (Rp)</label>
                <input type="number" name="realisasi" value="{{ old('realisasi', $pembangunan->realisasi) }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500" required>
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Lokasi / Dusun</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $pembangunan->lokasi) }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500">
            </div>
            <div class="space-y-1">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Titik Koordinat Lapangan</label>
                <input type="text" name="lat_long" value="{{ old('lat_long', $pembangunan->lat_long) }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500">
            </div>
        </div>
        
        <div class="space-y-1">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Deskripsi Lengkap Kegiatan</label>
            <textarea name="deskripsi" rows="3" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm font-bold p-3 focus:ring-brand-blue-500">{{ old('deskripsi', $pembangunan->deskripsi) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">
            <div class="space-y-3">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Foto Sebelum Pengerjaan</label>
                @if($pembangunan->foto_sebelum)
                    <div class="w-full aspect-video rounded-xl overflow-hidden border border-slate-200">
                        <img src="{{ asset($pembangunan->foto_sebelum) }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <input type="file" name="foto_sebelum" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-brand-blue-50 file:text-brand-blue-700 hover:file:bg-brand-blue-100" accept="image/*">
            </div>
            <div class="space-y-3">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Foto Sesudah Pengerjaan</label>
                @if($pembangunan->foto_sesudah)
                    <div class="w-full aspect-video rounded-xl overflow-hidden border border-slate-200">
                        <img src="{{ asset($pembangunan->foto_sesudah) }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <input type="file" name="foto_sesudah" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" accept="image/*">
            </div>
        </div>

        <div class="pt-4 flex justify-end gap-3">
            <a href="{{ route('pembangunan.index') }}" class="px-6 py-3 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-100">Batal</a>
            <button type="submit" class="btn-primary">Perbarui Data Pembangunan</button>
        </div>
    </form>
</div>
@endsection
