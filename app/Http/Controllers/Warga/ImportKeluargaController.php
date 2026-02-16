<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Imports\KeluargaImport;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exports\TemplateKeluargaExport;
use Maatwebsite\Excel\Facades\Excel;

class ImportKeluargaController extends Controller
{
    public function downloadTemplate()
    {
        return Excel::download(new TemplateKeluargaExport, 'template_import_keluarga.xlsx');
    }

    public function showForm()
    {
        $this->authorize('keluarga.create');

        return view('warga.keluarga.import');
    }

    public function preview(Request $request)
    {
        $this->authorize('keluarga.create');

        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls', 'max:5120'],
        ]);

        try {
            $import = new KeluargaImport();
            Excel::import($import, $request->file('file'));
            $rows = $import->getData();
        }
        catch (\Exception $e) {
            return back()->with('error', 'Gagal membaca file Excel: ' . $e->getMessage());
        }

        if (empty($rows)) {
            return back()->with('error', 'File Excel kosong atau format tidak sesuai.');
        }

        $errors = [];
        $validData = [];
        $seenNoKk = [];

        foreach ($rows as $index => $row) {
            $rowNum = $index + 2; // header = row 1
            $rowErrors = [];

            $no_kk = trim($row['no_kk'] ?? '');
            $kepala_keluarga = trim($row['kepala_keluarga'] ?? '');

            if (empty($no_kk))
                $rowErrors[] = "No KK wajib diisi.";
            elseif (strlen($no_kk) !== 16)
                $rowErrors[] = "No KK harus 16 digit.";

            if (empty($kepala_keluarga))
                $rowErrors[] = "Kepala Keluarga wajib diisi.";

            // Validasi Field Wajib Tambahan (Hanya Alamat)
            if (empty($row['alamat']))
                $rowErrors[] = "Alamat wajib diisi.";

            // RT, RW, Dusun, Kelurahan, Kecamatan, Kabupaten, Provinsi, Kode Pos -> Opsional

            // Cek duplikat dalam file
            if (!empty($no_kk)) {
                if (in_array($no_kk, $seenNoKk)) {
                    $rowErrors[] = "No KK duplikat dalam file.";
                }
                else {
                    $seenNoKk[] = $no_kk;
                }
            }

            // Cek duplikat di database (gunakan hash)
            if (!empty($no_kk) && empty($rowErrors)) {
                $hash = hash_hmac('sha256', $no_kk, config('app.key'));
                $exists = Keluarga::where('no_kk_hash', $hash)->exists();
                if ($exists) {
                    $rowErrors[] = "No KK sudah terdaftar di database.";
                }
            }

            if (!empty($rowErrors)) {
                $errors[] = "Baris {$rowNum}: " . implode(' ', $rowErrors);
            }

            $validData[] = [
                'no_kk' => $no_kk,
                'kepala_keluarga' => $kepala_keluarga,
                'alamat' => trim($row['alamat'] ?? ''),
                'rt' => trim($row['rt'] ?? ''),
                'rw' => trim($row['rw'] ?? ''),
                'dusun' => trim($row['dusun'] ?? ''),
                'kelurahan' => trim($row['kelurahan'] ?? ''),
                'kecamatan' => trim($row['kecamatan'] ?? ''),
                'kabupaten' => trim($row['kabupaten'] ?? ''),
                'provinsi' => trim($row['provinsi'] ?? ''),
                'kode_pos' => trim($row['kode_pos'] ?? ''),
                'errors' => $rowErrors,
            ];
        }

        session(['import_keluarga_data' => $validData]);

        return view('warga.keluarga.import-preview', compact('validData', 'errors'));
    }

    public function store(Request $request)
    {
        $this->authorize('keluarga.create');

        $data = session('import_keluarga_data');

        if (empty($data)) {
            return redirect()->route('keluarga.import')
                ->with('error', 'Tidak ada data untuk diimpor. Silakan upload ulang file.');
        }

        // Cek apakah ada baris error
        foreach ($data as $row) {
            if (!empty($row['errors'])) {
                return redirect()->route('keluarga.import')
                    ->with('error', 'Terdapat error pada data. Perbaiki file Excel dan upload ulang.');
            }
        }

        try {
            DB::transaction(function () use ($data) {
                foreach ($data as $row) {
                    Keluarga::create([
                        'no_kk' => $row['no_kk'],
                        'kepala_keluarga' => $row['kepala_keluarga'],
                        'alamat' => $row['alamat'] ?: null,
                        'rt' => $row['rt'] ?: null,
                        'rw' => $row['rw'] ?: null,
                        'dusun' => $row['dusun'] ?: null,
                        'kelurahan' => $row['kelurahan'] ?: null,
                        'kecamatan' => $row['kecamatan'] ?: null,
                        'kabupaten' => $row['kabupaten'] ?: null,
                        'provinsi' => $row['provinsi'] ?: null,
                        'kode_pos' => $row['kode_pos'] ?: null,
                        'created_by' => auth()->id(),
                        'updated_by' => auth()->id(),
                    ]);
                }
            });

            session()->forget('import_keluarga_data');

            return redirect()->route('keluarga.index')
                ->with('success', 'Berhasil mengimpor ' . count($data) . ' data keluarga.');
        }
        catch (\Exception $e) {
            Log::error('Import keluarga gagal: ' . $e->getMessage());

            return redirect()->route('keluarga.import')
                ->with('error', 'Gagal menyimpan data. Seluruh proses dibatalkan. Error: ' . $e->getMessage());
        }
    }
}
