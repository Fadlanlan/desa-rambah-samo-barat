<?php

namespace App\Repositories\Eloquent;

use App\Models\Antrian;
use App\Repositories\Interfaces\AntrianRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class AntrianRepository extends BaseRepository implements AntrianRepositoryInterface
{
    public function __construct(Antrian $model)
    {
        parent::__construct($model);
    }

    public function getAll(array $filters = []): Collection
    {
        $query = $this->model->newQuery();
        $this->applyFilters($query, $filters);
        return $query->get();
    }

    public function findById(int $id): ?Model
    {
        return $this->model->with(['penduduk', 'caller'])->find($id);
    }

    public function findByIdOrFail(int $id): Model
    {
        return $this->model->with(['penduduk', 'caller'])->findOrFail($id);
    }

    public function getPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->with(['penduduk', 'caller'])->latest();
        $this->applyFilters($query, $filters);
        return $query->paginate($perPage);
    }

    public function getQuotaCount(string $date): int
    {
        return $this->model->where('tanggal_kunjungan', $date)
            ->where('status', '!=', 'batal')
            ->count();
    }

    public function getNextNumber(string $date): int
    {
        $last = $this->model->where('tanggal_kunjungan', $date)
            ->orderBy('id', 'desc')
            ->first();

        if (!$last) {
            return 1;
        }

        // Extract number from nomor_antrian (e.g., A-001 -> 1)
        $parts = explode('-', $last->nomor_antrian);
        $lastPart = end($parts);
        $num = (int)$lastPart;

        return $num + 1;
    }

    public function findByToken(string $token): ?Antrian
    {
        return $this->model->where('token_akses', $token)->first();
    }

    public function getCurrentServing(): ?Antrian
    {
        return $this->model->where('tanggal_kunjungan', now()->toDateString())
            ->where('status', 'dipanggil')
            ->orderBy('called_at', 'desc')
            ->first();
    }

    public function getTodayWaiting(): Collection
    {
        return $this->model->where('tanggal_kunjungan', now()->toDateString())
            ->where('status', 'menunggu')
            ->orderBy('nomor_antrian', 'asc')
            ->get();
    }

    protected function applyFilters(Builder $query, array $filters): Builder
    {
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['tanggal'])) {
            $query->where('tanggal_kunjungan', $filters['tanggal']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function (Builder $q) use ($search) {
                return $q->where('nomor_antrian', 'like', "%{$search}%")
                ->orWhere('nama_pengunjung', 'like', "%{$search}%")
                ->orWhere('nik_pengunjung', 'like', "%{$search}%");
            });
        }

        return $query;
    }
}
