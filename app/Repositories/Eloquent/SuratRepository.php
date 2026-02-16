<?php

namespace App\Repositories\Eloquent;

use App\Models\Surat;
use App\Repositories\Interfaces\SuratRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class SuratRepository extends BaseRepository implements SuratRepositoryInterface
{
    public function __construct(Surat $model)
    {
        parent::__construct($model);
    }

    public function getAll(array $filters = []): Collection
    {
        $query = $this->model->with(['jenisSurat', 'penduduk', 'processor'])->latest();
        $this->applyFilters($query, $filters);
        return $query->get();
    }

    public function findById(int $id): ?Model
    {
        return $this->model->with(['jenisSurat', 'penduduk', 'processor', 'approver', 'rejector', 'logSurat.user'])->find($id);
    }

    public function findByIdOrFail(int $id): Model
    {
        return $this->model->with(['jenisSurat', 'penduduk', 'processor', 'approver', 'rejector', 'logSurat.user'])->findOrFail($id);
    }

    public function findByUuid(string $uuid): ?Model
    {
        return $this->model->with(['jenisSurat', 'penduduk'])->where('uuid', $uuid)->first();
    }

    public function getPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->with(['jenisSurat', 'penduduk'])->latest();
        $this->applyFilters($query, $filters);
        return $query->paginate($perPage);
    }

    public function update(int $id, array $newDetails): Model
    {
        $record = $this->model->findOrFail($id);
        $record->update($newDetails);

        return $record->fresh();
    }

    public function getByStatus(string $status, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->where('status', $status)
            ->with(['jenisSurat', 'penduduk'])
            ->latest()
            ->paginate($perPage);
    }

    public function getByPenduduk(int $pendudukId): Collection
    {
        return $this->model->where('penduduk_id', $pendudukId)
            ->with(['jenisSurat'])
            ->latest()
            ->get();
    }

    /**
     * Get the last sequence number for a letter type in a given month + year.
     * Uses lockForUpdate to prevent race conditions.
     */
    public function getLastSequenceNumber(int $jenisSuratId, int $year, int $month = null): int
    {
        $month = $month ?? now()->month;

        $lastSurat = $this->model->where('jenis_surat_id', $jenisSuratId)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->whereNotNull('nomor_surat')
            ->lockForUpdate()
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastSurat || !preg_match('/\/(\d+)\//', $lastSurat->nomor_surat, $matches)) {
            return 0;
        }

        return (int)$matches[1];
    }

    /**
     * Get surat statistics for dashboard.
     */
    public function getStats(): array
    {
        return [
            'total_bulan_ini' => $this->model->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)->count(),
            'menunggu' => $this->model->whereIn('status', ['draft', 'diajukan'])->count(),
            'diproses' => $this->model->where('status', 'diproses')->count(),
            'selesai' => $this->model->where('status', 'selesai')->count(),
            'ditolak' => $this->model->where('status', 'ditolak')->count(),
        ];
    }

    protected function applyFilters(Builder $query, array $filters): Builder
    {
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['jenis_surat_id'])) {
            $query->where('jenis_surat_id', $filters['jenis_surat_id']);
        }

        if (!empty($filters['search'])) {
            $search = (string)$filters['search'];
            return $query->where(function ($q) use ($search) {
                /** @var \Illuminate\Database\Eloquent\Builder $q */
                return $q->whereHas('penduduk', function ($qPenduduk) use ($search) {
                        /** @var \Illuminate\Database\Eloquent\Builder $qPenduduk */
                        return $qPenduduk->where('nama', 'like', '%' . $search . '%')
                            ->orWhere('nik', 'like', '%' . $search . '%');
                    }
                    )->orWhere('nomor_surat', 'like', '%' . $search . '%');
                });
        }

        return $query;
    }
}
