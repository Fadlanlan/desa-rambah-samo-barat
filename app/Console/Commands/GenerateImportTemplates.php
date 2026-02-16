<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class GenerateImportTemplates extends Command
{
    protected $signature = 'import:generate-templates';
    protected $description = 'Generate Excel template files for Keluarga and Penduduk import';

    public function handle(): int
    {
        $dir = public_path('templates');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // --- Keluarga Template ---
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Template Keluarga');

        $headers = ['no_kk', 'kepala_keluarga', 'alamat', 'rt', 'rw', 'dusun', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'kode_pos'];
        $sample = ['1234567890123456', 'Ahmad Sudirman', 'Jl. Merdeka No. 10', '001', '002', 'Dusun I', 'Rambah Samo Barat', 'Rambah Samo', 'Rokan Hulu', 'Riau', '28557'];

        foreach ($headers as $col => $header) {
            $sheet->setCellValueByColumnAndRow($col + 1, 1, $header);
            $sheet->getStyleByColumnAndRow($col + 1, 1)->getFont()->setBold(true);
        }
        foreach ($sample as $col => $value) {
            $sheet->setCellValueExplicitByColumnAndRow($col + 1, 2, $value, DataType::TYPE_STRING);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($dir . '/template_import_keluarga.xlsx');
        $this->info('template_import_keluarga.xlsx created.');

        // --- Penduduk Template ---
        $spreadsheet2 = new Spreadsheet();
        $sheet2 = $spreadsheet2->getActiveSheet();
        $sheet2->setTitle('Template Penduduk');

        $headers2 = ['nik', 'nama', 'no_kk', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'status_perkawinan', 'pekerjaan', 'pendidikan_terakhir', 'kewarganegaraan', 'alamat', 'rt', 'rw', 'dusun', 'golongan_darah', 'status_hubungan', 'status'];
        $sample2 = ['1234567890123456', 'Budi Santoso', '1234567890123456', 'Pekanbaru', '1990-05-15', 'L', 'Islam', 'Kawin', 'Petani', 'SMA', 'WNI', 'Jl. Merdeka No. 10', '001', '002', 'Dusun I', 'O', 'Kepala Keluarga', 'aktif'];

        foreach ($headers2 as $col => $header) {
            $sheet2->setCellValueByColumnAndRow($col + 1, 1, $header);
            $sheet2->getStyleByColumnAndRow($col + 1, 1)->getFont()->setBold(true);
        }
        foreach ($sample2 as $col => $value) {
            $sheet2->setCellValueExplicitByColumnAndRow($col + 1, 2, $value, DataType::TYPE_STRING);
        }

        $writer2 = new Xlsx($spreadsheet2);
        $writer2->save($dir . '/template_import_penduduk.xlsx');
        $this->info('template_import_penduduk.xlsx created.');

        $this->info('All templates generated successfully!');
        return Command::SUCCESS;
    }
}
