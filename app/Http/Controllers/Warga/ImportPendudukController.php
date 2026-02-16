<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Imports\PendudukImport;
use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exports\TemplatePendudukExport;
use Maatwebsite\Excel\Facades\Excel;

class ImportPendudukController extends Controller
{
    public function downloadTemplate()
    {
        return Excel::download(new TemplatePendudukExport, 'template_import_penduduk.xlsx');
    }

    public function showForm()
    {
        $this->authorize('penduduk.create');

        return view('warga.import');
    }

    public function preview(Request $request)
    {
        $this->authorize('penduduk.create');

        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls', 'max:5120'],
        ]);

        try {
            $import = new PendudukImport();
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
        $seenNik = [];

        foreach ($rows as $index => $row) {
            $rowNum = $index + 2;
            $rowErrors = [];

            $nik = trim($row['nik'] ?? '');
            $nama = trim($row['nama'] ?? '');
            $no_kk = trim($row['no_kk'] ?? '');
            $jenis_kelamin = strtoupper(trim($row['jenis_kelamin'] ?? ''));

            // Validasi field wajib
            if (empty($nik))
                $rowErrors[] = "NIK wajib diisi.";
            elseif (strlen($nik) !== 16)
                $rowErrors[] = "NIK harus 16 digit.";

            if (empty($nama))
                $rowErrors[] = "Nama wajib diisi.";
            if (empty($no_kk))
                $rowErrors[] = "No KK wajib diisi.";

            // Validasi tambahan sesuai request (Hanya Alamat yang wajib)
            if (empty($row['alamat']))
                $rowErrors[] = "Alamat wajib diisi.";

            // Dusun, RT, RW, Status, Tempat Lahir, Tanggal Lahir -> Opsional
            // Jenis Kelamin -> Opsional (sudah dihandle migration nullable)

            // Cek duplikat NIK dalam file
            if (!empty($nik)) {
                if (in_array($nik, $seenNik)) {
                    $rowErrors[] = "NIK duplikat dalam file.";
                }
                else {
                    $seenNik[] = $nik;
                }
            }

            // Cek duplikat NIK di database
            if (!empty($nik) && empty($rowErrors)) {
                $hash = hash_hmac('sha256', $nik, config('app.key'));
                $exists = Penduduk::where('nik_hash', $hash)->exists();
                if ($exists) {
                    $rowErrors[] = "NIK sudah terdaftar di database.";
                }
            }

            // Cek relasi no_kk ke tabel keluarga
            $keluargaId = null;
            $kepalaKeluarga = null;
            if (!empty($no_kk)) {
                $kkHash = hash_hmac('sha256', $no_kk, config('app.key'));
                $keluarga = Keluarga::where('no_kk_hash', $kkHash)->first();
                if (!$keluarga) {
                    $rowErrors[] = "No KK '{$no_kk}' tidak ditemukan di tabel Keluarga.";
                }
                else {
                    $keluargaId = $keluarga->id;
                    $kepalaKeluarga = $keluarga->kepala_keluarga;
                }
            }

            $validData[] = [
                'nik' => $nik,
                'nama' => $nama,
                'no_kk' => $no_kk,
                'keluarga_id' => $keluargaId,
                'kepala_keluarga' => $kepalaKeluarga,
                'tempat_lahir' => trim($row['tempat_lahir'] ?? ''),
                'tanggal_lahir' => trim($row['tanggal_lahir'] ?? ''),
                'jenis_kelamin' => $jenis_kelamin,
                'agama' => trim($row['agama'] ?? ''),
                'status_perkawinan' => trim($row['status_perkawinan'] ?? ''),
                'pekerjaan' => trim($row['pekerjaan'] ?? ''),
                'pendidikan_terakhir' => trim($row['pendidikan_terakhir'] ?? ''),
                'kewarganegaraan' => trim($row['kewarganegaraan'] ?? '') ?: 'WNI',
                'alamat' => trim($row['alamat'] ?? ''),
                'rt' => trim($row['rt'] ?? ''),
                'rw' => trim($row['rw'] ?? ''),
                'dusun' => trim($row['dusun'] ?? ''),
                'golongan_darah' => trim($row['golongan_darah'] ?? ''),
                'status_hubungan' => trim($row['status_hubungan_dalam_keluarga'] ?? $row['status_hubungan'] ?? ''), // Handle variation
                'status' => trim($row['status'] ?? '') ?: 'aktif',
                'errors' => $rowErrors,
            ];

            if (!empty($rowErrors)) {
                foreach ($rowErrors as $err) {
                    $errors[] = "Baris {$rowNum}: {$err}";
                }
            }
        }

        session(['import_penduduk_data' => $validData]);

        return view('warga.import-preview', compact('validData', 'errors'));
    }

    public function store(Request $request)
    {
        $this->authorize('penduduk.create');

        $data = session('import_penduduk_data');

        if (empty($data)) {
            return redirect()->route('warga.import')
                ->with('error', 'Tidak ada data untuk diimpor. Silakan upload ulang file.');
        }

        // Cek apakah ada baris error
        foreach ($data as $row) {
            if (!empty($row['errors'])) {
                return redirect()->route('warga.import')
                    ->with('error', 'Terdapat error pada data. Perbaiki file Excel dan upload ulang.');
            }
        }

        try {
            DB::transaction(function () use ($data) {
                foreach ($data as $row) {
                    Penduduk::create([
                        'keluarga_id' => $row['keluarga_id'],
                        'nik' => $row['nik'],
                        'nama' => $row['nama'],
                        'tempat_lahir' => $row['tempat_lahir'] ?: null,
                        'tanggal_lahir' => !empty($row['tanggal_lahir']) ? $row['tanggal_lahir'] : null,
                        'jenis_kelamin' => $row['jenis_kelamin'],
                        'agama' => $row['agama'] ?: null,
                        'status_perkawinan' => $row['status_perkawinan'] ?: null,
                        'pekerjaan' => $row['pekerjaan'] ?: null,
                        'pendidikan_terakhir' => $row['pendidikan_terakhir'] ?: null,
                        'kewarganegaraan' => $row['kewarganegaraan'],
                        'alamat' => $row['alamat'] ?: null,
                        'rt' => $row['rt'] ?: null,
                        'rw' => $row['rw'] ?: null,
                        'dusun' => $row['dusun'] ?: null,
                        'golongan_darah' => $row['golongan_darah'] ?: null,
                        'status_hubungan' => $row['status_hubungan'] ?: null,
                        'status' => $row['status'],
                        'created_by' => auth()->id(),
                        'updated_by' => auth()->id(),
                    ]);
                }
            });

            session()->forget('import_penduduk_data');

            return redirect()->route('warga.index')
                ->with('success', 'Berhasil mengimpor ' . count($data) . ' data penduduk.');
        }
        catch (\Exception $e) {
            Log::error('Import penduduk gagal: ' . $e->getMessage());

            return redirect()->route('warga.import')
                ->with('error', 'Gagal menyimpan data. Seluruh proses dibatalkan. Error: ' . $e->getMessage());
        }
    }
}
