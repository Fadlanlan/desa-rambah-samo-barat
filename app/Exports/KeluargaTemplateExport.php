<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KeluargaTemplateExport implements FromArray, WithHeadings, WithStyles
{
    public function headings(): array
    {
        return [
            'no_kk',
            'kepala_keluarga',
            'alamat',
            'rt',
            'rw',
            'dusun',
            'kelurahan',
            'kecamatan',
            'kabupaten',
            'provinsi',
            'kode_pos',
        ];
    }

    public function array(): array
    {
        return [
            [
                '1234567890123456',
                'Ahmad Sudirman',
                'Jl. Merdeka No. 10',
                '001',
                '002',
                'Dusun I',
                'Rambah Samo Barat',
                'Rambah Samo',
                'Rokan Hulu',
                'Riau',
                '28557',
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
