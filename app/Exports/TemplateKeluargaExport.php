<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateKeluargaExport implements WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    public function headings(): array
    {
        return [
            'No KK',
            'Kepala Keluarga',
            'Alamat',
            'RT (Opsional)',
            'RW (Opsional)',
            'Dusun (Opsional)',
            'Kelurahan (Opsional)',
            'Kecamatan (Opsional)',
            'Kabupaten (Opsional)',
            'Provinsi (Opsional)',
            'Kode Pos (Opsional)',
        ];
    }

    public function title(): string
    {
        return 'Template Import Keluarga';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
