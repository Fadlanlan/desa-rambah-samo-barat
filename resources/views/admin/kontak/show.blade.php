@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('page_title', 'Detail Pesan')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('kontak.index') }}" class="text-slate-500 hover:text-slate-700">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-900">Baca Pesan</h1>
    </div>

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6 bg-slate-50 border-b border-slate-200">
            <h3 class="text-lg font-medium leading-6 text-slate-900">{{ $item->subject }}</h3>
            <p class="mt-1 text-sm text-slate-500">Diterima pada {{ $item->created_at->format('d F Y, H:i') }} WIB</p>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-slate-500">Nama Pengirim</dt>
                    <dd class="mt-1 text-sm text-slate-900">{{ $item->nama }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-slate-500">Email</dt>
                    <dd class="mt-1 text-sm text-slate-900">{{ $item->email }}</dd>
                    @if($item->telepon)
                        <dt class="text-sm font-medium text-slate-500 mt-2">Nomor Telepon</dt>
                        <dd class="mt-1 text-sm text-slate-900">{{ $item->telepon }}</dd>
                    @endif
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-slate-500">Isi Pesan</dt>
                    <dd class="mt-2 text-sm text-slate-900 whitespace-pre-wrap rounded-md bg-slate-50 p-4 border border-slate-200">{{ $item->pesan }}</dd>
                </div>
            </div>
        </div>
        <div class="px-4 py-4 sm:px-6 bg-slate-50 border-t border-slate-200 flex justify-end gap-x-3">
            <form action="{{ route('kontak.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-red-600 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50">Hapus Pesan</button>
            </form>
            <a href="mailto:{{ $item->email }}?subject=Balasan: {{ $item->subject }}" class="rounded-md bg-brand-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue-600">
                Balas via Email
            </a>
        </div>
    </div>
</div>
@endsection
