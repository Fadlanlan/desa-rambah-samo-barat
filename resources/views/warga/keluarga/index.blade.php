@extends('layouts.admin')

@section('title', 'Data Keluarga - Desa Rambah Samo Barat')
@section('page_title', 'Manajemen Kartu Keluarga')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-3 bg-brand-green-50 rounded-lg text-brand-green-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-900">Daftar Kartu Keluarga</h3>
                <p class="text-sm text-slate-500">Kelola informasi rumah tangga dan anggota keluarga di desa.</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @can('keluarga.create')
            <a href="{{ route('keluarga.import') }}" class="btn-secondary bg-white !text-slate-700 border border-slate-200">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Import Excel
            </a>
            <a href="{{ route('keluarga.create') }}" class="btn-primary">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah KK Baru
            </a>
            @endcan
        </div>
    </div>

    <!-- Filters -->
    <div class="card p-4">
        <form action="{{ route('keluarga.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <x-text-input name="search" placeholder="Cari No. KK atau Alamat..." class="w-full" value="{{ request('search') }}" />
            </div>
            <div>
                <select name="dusun" class="w-full border-slate-200 rounded-lg text-sm focus:border-brand-blue-500 focus:ring-brand-blue-500">
                    <option value="">Semua Dusun</option>
                    <option value="Dusun I" {{ request('dusun') == 'Dusun I' ? 'selected' : '' }}>Dusun I</option>
                    <option value="Dusun II" {{ request('dusun') == 'Dusun II' ? 'selected' : '' }}>Dusun II</option>
                    <option value="Dusun III" {{ request('dusun') == 'Dusun III' ? 'selected' : '' }}>Dusun III</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full btn-secondary justify-center py-2.5">
                    Filter KK
                </button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr class="text-xs uppercase tracking-wider font-bold text-slate-500">
                        <th class="px-6 py-4">No. Kartu Keluarga</th>
                        <th class="px-6 py-4">Kepala Keluarga</th>
                        <th class="px-6 py-4">Alamat</th>
                        <th class="px-6 py-4">Dusun</th>
                        <th class="px-6 py-4">RT/RW</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @if ($keluarga->count() > 0)
                        @foreach ($keluarga as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-brand-blue-600 font-bold uppercase tracking-tight">{{ $item->no_kk }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900">{{ $item->kepala_keluarga }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 truncate max-w-[200px]">{{ $item->alamat }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-700">{{ $item->dusun }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $item->rt ?? '00' }}/{{ $item->rw ?? '00' }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @can('keluarga.view')
                                <a href="{{ route('keluarga.show', $item->id) }}" class="text-brand-blue-600 hover:text-brand-blue-800 transition-colors">
                                    <svg class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                @endcan
                                
                                @can('keluarga.edit')
                                <a href="{{ route('keluarga.edit', $item->id) }}" class="text-brand-green-600 hover:text-brand-green-800 transition-colors">
                                    <svg class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                @endcan

                                @can('keluarga.delete')
                                <form action="{{ route('keluarga.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kartu keluarga ini? Semua data anggota keluarga yang terhubung akan kehilangan referensi KK.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                                        <svg class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center text-slate-400">
                                 <div class="flex flex-col items-center">
                                    <svg class="h-12 w-12 text-slate-200 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    <p class="text-lg font-medium text-slate-500">Tidak ada data kartu keluarga ditemukan</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        @if($keluarga->hasPages())
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
            {{ $keluarga->links() }}
        </div>
        @endif
    </div>

    {{-- Hapus Semua Data --}}
    @can('keluarga.delete')
    @if($keluarga->count() > 0)
    <div class="flex justify-end" x-data="{ showDeleteModal: false, deleteConfirmed: false }">
        <button @click="showDeleteModal = true" type="button"
            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-lg transition-colors">
            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Hapus Semua Data
        </button>

        {{-- Modal Konfirmasi 1 --}}
        <div x-show="showDeleteModal && !deleteConfirmed" x-cloak style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="fixed inset-0 bg-slate-900/60" @click="showDeleteModal = false"></div>
            <div class="relative bg-white rounded-xl shadow-2xl max-w-md w-full p-6 z-10" @click.away="showDeleteModal = false">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-3 bg-red-100 rounded-full">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Hapus Semua Data Keluarga?</h3>
                        <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
                <p class="text-sm text-slate-600 mb-6">Anda akan menghapus <span class="font-bold text-red-600">seluruh data kartu keluarga</span> secara permanen dari database. Anggota keluarga (penduduk) yang terkait akan <strong>tetap ada namun tidak memiliki KK</strong>. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="flex items-center justify-end gap-3">
                    <button @click="showDeleteModal = false" type="button" class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">Batal</button>
                    <button @click="deleteConfirmed = true" type="button" class="px-4 py-2 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">Ya, Lanjutkan</button>
                </div>
            </div>
        </div>

        {{-- Modal Konfirmasi 2 (Final) --}}
        <div x-show="showDeleteModal && deleteConfirmed" x-cloak style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="fixed inset-0 bg-slate-900/60" @click="showDeleteModal = false; deleteConfirmed = false"></div>
            <div class="relative bg-white rounded-xl shadow-2xl max-w-md w-full p-6 z-10 border-2 border-red-300">
                <div class="text-center mb-4">
                    <div class="mx-auto p-4 bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mb-3">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-red-700">KONFIRMASI TERAKHIR</h3>
                    <p class="text-sm text-slate-600 mt-2">Anda <span class="font-bold">benar-benar yakin</span> ingin menghapus seluruh data kartu keluarga?<br>Data yang dihapus <span class="font-bold text-red-600">tidak bisa dikembalikan</span>.</p>
                </div>
                <div class="flex items-center justify-center gap-3 mt-6">
                    <button @click="showDeleteModal = false; deleteConfirmed = false" type="button" class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">Batal</button>
                    <form action="{{ route('keluarga.destroy-all') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">Hapus Semua Data Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endcan
</div>
@endsection
