<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WargaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Penduduk::with('keluarga')->get();
    }

    public function headings(): array
    {
        return [
            'NIK',
            'No KK',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Status Perkawinan',
            'Pekerjaan',
            'Pendidikan',
            'Kewarganegaraan',
            'Alamat',
            'RT',
            'RW',
            'Dusun',
            'Status Hubungan',
            'Status Penduduk',
        ];
    }

    public function map($penduduk): array
    {
        return [
            "'" . $penduduk->nik, // Force string for Excel
            $penduduk->keluarga ? "'" . $penduduk->keluarga->no_kk : '-',
            $penduduk->nama,
            $penduduk->jenis_kelamin,
            $penduduk->tempat_lahir,
            $penduduk->tanggal_lahir,
            $penduduk->agama,
            $penduduk->status_perkawinan,
            $penduduk->pekerjaan,
            $penduduk->pendidikan_terakhir,
            $penduduk->kewarganegaraan,
            $penduduk->alamat,
            $penduduk->rt,
            $penduduk->rw,
            $penduduk->dusun,
            $penduduk->status_hubungan,
            $penduduk->status,
        ];
    }
}
