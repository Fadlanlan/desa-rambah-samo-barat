@extends('layouts.admin')

@section('title', 'Detail Permohonan Surat')
@section('page_title', 'Detail Permohonan Surat')

@section('content')
<div class="max-w-5xl mx-auto">
    <a href="{{ route('surat.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-brand-blue-600 transition-colors mb-6">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="card p-8">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $item->jenisSurat->nama }}</h3>
                        <div class="flex items-center gap-2 mt-1">
                            <p class="text-sm text-slate-500">Nomor: <span class="font-mono font-bold text-brand-blue-600 uppercase">{{ $item->nomor_surat ?? 'BELUM DIPROSES' }}</span></p>
                            @if($item->hash_verifikasi)
                            <div class="flex items-center gap-1 ml-2" title="Hash Verifikasi Dokumen">
                                <svg class="h-3 w-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 4.946-3.07 9.173-7.393 10.8a1 1 0 01-.608 0L10 18.2a11.952 11.952 0 01-7.834-11.2c0-.68.056-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <span class="text-[9px] font-mono text-slate-400">Verified</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase 
                        @if($item->status == 'diajukan') bg-amber-100 text-amber-700
                        @elseif($item->status == 'diproses') bg-brand-blue-100 text-brand-blue-700
                        @elseif($item->status == 'selesai') bg-slate-700 text-white
                        @elseif($item->status == 'ditolak') bg-red-100 text-red-700
                        @else bg-slate-100 text-slate-600 @endif">
                        {{ $item->status == 'diajukan' ? 'MENUNGGU' : $item->status }}
                    </span>
                </div>

                <div class="space-y-6">
                    <div>
                        <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Informasi Pemohon</h4>
                        <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 rounded-lg border border-slate-100">
                            <div>
                                <p class="text-[10px] text-slate-400 mb-1">Nama Lengkap</p>
                                <p class="text-sm font-bold text-slate-800">{{ $item->penduduk->nama }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-400 mb-1">NIK</p>
                                <p class="text-sm font-mono text-slate-800">{{ $item->penduduk->nik }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-400 mb-1">Tempat, Tgl Lahir</p>
                                <p class="text-sm text-slate-800">{{ $item->penduduk->tempat_lahir }}, {{ $item->penduduk->tanggal_lahir ? $item->penduduk->tanggal_lahir->format('d/m/Y') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-400 mb-1">Status / Pekerjaan</p>
                                <p class="text-sm text-slate-800">{{ $item->penduduk->status }} / {{ $item->penduduk->pekerjaan }}</p>
                            </div>
                        </div>
                    </div>



                    <div>
                        <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Maksud / Tujuan (Keperluan)</h4>
                        <div class="bg-white border border-slate-100 p-4 rounded-lg font-medium text-sm text-slate-700">
                            {{ $item->keperluan ?? 'Tidak ada data keperluan.' }}
                        </div>
                    </div>

                    <div>
                        <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Catatan Tambahan</h4>
                        <div class="bg-white border border-slate-100 p-4 rounded-lg italic text-sm text-slate-600">
                            "{{ $item->keterangan ?? 'Tidak ada catatan tambahan.' }}"
                        </div>
                    </div>

                    @if($item->status == 'ditolak')
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <h4 class="text-xs font-bold text-red-700 uppercase tracking-tight mb-2">Alasan Penolakan</h4>
                        <p class="text-sm text-red-600">{{ $item->alasan_penolakan }}</p>
                        <p class="text-[10px] text-red-400 mt-2 italic">Ditolak oleh: {{ $item->rejector->name ?? 'Sistem' }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-6">
            <div class="card p-6">
                <h4 class="text-xs font-bold text-slate-900 uppercase tracking-widest mb-4">Tindakan Pelayanan</h4>
                
                <div class="space-y-3">
                    @if($item->status == 'diajukan')
                    <form action="{{ route('surat.process', $item->id) }}" method="POST" onsubmit="return confirm('Proses permohonan ini dan generate nomor surat?')">
                        @csrf
                        <button type="submit" class="w-full btn-primary py-3">
                            Setujui & Proses
                        </button>
                    </form>

                    <button @click="$dispatch('open-modal', 'reject-modal')" class="w-full btn-secondary py-3 !text-red-600 border-red-200 hover:bg-red-50">
                        Tolak Permohonan
                    </button>
                    @endif

                    @if($item->status == 'diproses')
                    <form action="{{ route('surat.finish', $item->id) }}" method="POST" onsubmit="return confirm('Tandai permohonan ini sebagai selesai? (Sudah diambil/diserahkan)')">
                        @csrf
                        <button type="submit" class="w-full btn-primary py-3 !bg-emerald-600 hover:!bg-emerald-700">
                            Selesaikan (Siap Ambil)
                        </button>
                    </form>
                    @endif

                    @if($item->status == 'diproses' || $item->status == 'selesai')
                    <a href="{{ route('surat.download', $item->id) }}" class="w-full btn-secondary py-3 flex items-center justify-center gap-2 !bg-brand-blue-600 hover:!bg-brand-blue-700 !text-white">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Download PDF Resmi
                    </a>
                    @endif
                </div>
            </div>

            <div class="card p-6 bg-slate-50 border-dashed border-slate-200">
                <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Timeline Aktivitas</h4>
                <div class="space-y-6 relative before:absolute before:inset-0 before:left-3 before:w-px before:bg-slate-200 before:pointer-events-none">
                    @if($item->logSurat->count() > 0)
                        @foreach($item->logSurat as $log)
                        <div class="relative pl-8">
                            <div class="absolute left-1.5 top-1.5 h-3 w-3 rounded-full border-2 border-white 
                                @if($log->aksi == 'pengajuan') bg-amber-400
                                @elseif($log->aksi == 'disetujui') bg-emerald-500
                                @elseif($log->aksi == 'selesai') bg-brand-blue-600
                                @elseif($log->aksi == 'ditolak') bg-red-500
                                @else bg-slate-400 @endif
                            "></div>
                            <p class="text-[11px] font-bold text-slate-800 leading-tight">{{ strtoupper($log->aksi) }}</p>
                            <p class="text-[10px] text-slate-500 mt-1 leading-relaxed">{{ $log->keterangan }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-[9px] text-slate-400 font-mono">{{ $log->created_at->format('d/m/Y H:i') }}</span>
                                @if($log->user)
                                <span class="text-[9px] text-slate-400 italic">oleh {{ $log->user->name }}</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-[10px] text-slate-400 italic text-center py-4">Belum ada riwayat aktivitas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<x-modal name="reject-modal" focusable>
    <form action="{{ route('surat.reject', $item->id) }}" method="POST" class="p-6">
        @csrf
        <h2 class="text-lg font-bold text-slate-900">Tolak Permohonan Surat</h2>
        <p class="mt-1 text-sm text-slate-600">Sampaikan alasan penolakan agar pemohon dapat mengetahuinya.</p>

        <div class="mt-6">
            <x-input-label for="alasan_penolakan" value="Alasan Penolakan" class="sr-only" />
            <textarea id="alasan_penolakan" name="alasan_penolakan" class="block w-full border-slate-200 rounded-lg text-sm" rows="3" placeholder="Contoh: Lampiran tidak lengkap, dsb." required></textarea>
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
            <x-danger-button class="ml-3">Tolak Permohonan</x-danger-button>
        </div>
    </form>
</x-modal>
@endsection
