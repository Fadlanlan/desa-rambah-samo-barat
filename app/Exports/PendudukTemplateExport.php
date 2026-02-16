<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendudukTemplateExport implements FromArray, WithHeadings, WithStyles
{
    public function headings(): array
    {
        return [
            'nik',
            'nama',
            'no_kk',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'status_perkawinan',
            'pekerjaan',
            'pendidikan_terakhir',
            'kewarganegaraan',
            'alamat',
            'rt',
            'rw',
            'dusun',
            'golongan_darah',
            'status_hubungan',
            'status',
        ];
    }

    public function array(): array
    {
        return [
            [
                '1234567890123456',
                'Budi Santoso',
                '1234567890123456',
                'Pekanbaru',
                '1990-05-15',
                'L',
                'Islam',
                'Kawin',
                'Petani',
                'SMA',
                'WNI',
                'Jl. Merdeka No. 10',
                '001',
                '002',
                'Dusun I',
                'O',
                'Kepala Keluarga',
                'aktif',
            ],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
