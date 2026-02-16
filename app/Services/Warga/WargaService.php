<?php

namespace App\Services\Warga;

use App\Repositories\Interfaces\PendudukRepositoryInterface;
use App\Repositories\Interfaces\KeluargaRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class WargaService
{
    protected $pendudukRepository;
    protected $keluargaRepository;

    public function __construct(
        PendudukRepositoryInterface $pendudukRepository,
        KeluargaRepositoryInterface $keluargaRepository
        )
    {
        $this->pendudukRepository = $pendudukRepository;
        $this->keluargaRepository = $keluargaRepository;
    }

    public function getListPenduduk(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->pendudukRepository->getPaginated($perPage, $filters);
    }

    public function getPendudukDetail(int $id)
    {
        return $this->pendudukRepository->findById($id);
    }

    public function createPenduduk(array $data)
    {
        try {
            // Handle No KK Lookup
            if (!empty($data['no_kk'])) {
                $noKKHash = hash_hmac('sha256', $data['no_kk'], config('app.key'));
                $keluarga = \App\Models\Keluarga::where('no_kk_hash', $noKKHash)->first();

                if ($keluarga) {
                    $data['keluarga_id'] = $keluarga->id;
                }
                else {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'no_kk' => ['Nomor Kartu Keluarga tidak ditemukan dalam database. Silakan daftarkan Keluarga terlebih dahulu.']
                    ]);
                }
            }

            return $this->pendudukRepository->create($data);
        }
        catch (\Exception $e) {
            Log::error("Error creating penduduk: " . $e->getMessage());
            throw $e;
        }
    }

    public function updatePenduduk(int $id, array $data)
    {
        try {
            // Handle No KK Lookup
            if (!empty($data['no_kk'])) {
                $noKKHash = hash_hmac('sha256', $data['no_kk'], config('app.key'));
                $keluarga = \App\Models\Keluarga::where('no_kk_hash', $noKKHash)->first();

                if ($keluarga) {
                    $data['keluarga_id'] = $keluarga->id;
                }
                else {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'no_kk' => ['Nomor Kartu Keluarga tidak ditemukan dalam database.']
                    ]);
                }
            }

            return $this->pendudukRepository->update($id, $data);
        }
        catch (\Exception $e) {
            Log::error("Error updating penduduk (ID {$id}): " . $e->getMessage());
            throw $e;
        }
    }

    public function deletePenduduk(int $id)
    {
        try {
            return $this->pendudukRepository->delete($id);
        }
        catch (\Exception $e) {
            Log::error("Error deleting penduduk (ID {$id}): " . $e->getMessage());
            throw $e;
        }
    }

    // Keluarga Methods
    public function getListKeluarga(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->keluargaRepository->getPaginated($perPage, $filters);
    }

    public function getKeluargaDetail(int $id)
    {
        return $this->keluargaRepository->findById($id);
    }

    public function createKeluarga(array $data)
    {
        try {
            return $this->keluargaRepository->create($data);
        }
        catch (\Exception $e) {
            Log::error("Error creating keluarga: " . $e->getMessage());
            throw $e;
        }
    }

    public function updateKeluarga(int $id, array $data)
    {
        try {
            return $this->keluargaRepository->update($id, $data);
        }
        catch (\Exception $e) {
            Log::error("Error updating keluarga (ID {$id}): " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteKeluarga(int $id)
    {
        try {
            return $this->keluargaRepository->delete($id);
        }
        catch (\Exception $e) {
            Log::error("Error deleting keluarga (ID {$id}): " . $e->getMessage());
            throw $e;
        }
    }
}
