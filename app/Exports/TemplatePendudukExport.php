<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplatePendudukExport implements WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    public function headings(): array
    {
        return [
            'NIK',
            'No KK',
            'Nama',
            'Alamat',
            'RT (Opsional)',
            'RW (Opsional)',
            'Dusun (Opsional)',
            'Status (Opsional)',
            'Tempat Lahir (Opsional)',
            'Tanggal Lahir (Opsional)',
            'Jenis Kelamin (Opsional)',
            'Agama (Opsional)',
            'Status Perkawinan (Opsional)',
            'Pekerjaan (Opsional)',
            'Pendidikan Terakhir (Opsional)',
            'Kewarganegaraan (Opsional)',
            'Golongan Darah (Opsional)',
            'Status Hubungan Dalam Keluarga (Opsional)'
        ];
    }

    public function title(): string
    {
        return 'Template Import Penduduk';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
