<?php

namespace App\Repositories\Eloquent;

use App\Models\Penduduk;
use App\Repositories\Interfaces\PendudukRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PendudukRepository extends BaseRepository implements PendudukRepositoryInterface
{
    public function __construct(Penduduk $model)
    {
        parent::__construct($model);
    }

    public function findById(int $id): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->model->with(['keluarga'])->find($id);
    }

    public function getPaginated(int $perPage = 15, array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->model->with(['keluarga']);
        $this->applyFilters($query, $filters);
        return $query->paginate($perPage);
    }

    public function getAll(array $filters = []): Collection
    {
        $query = $this->model->with(['keluarga']);
        $this->applyFilters($query, $filters);
        return $query->get();
    }

    public function findByNik(string $nik)
    {
        $hash = hash_hmac('sha256', $nik, config('app.key'));
        return $this->model->where('nik_hash', $hash)->first();
    }

    public function search(string $query): Collection
    {
        $queryHash = hash_hmac('sha256', $query, config('app.key'));
        return $this->model->where('nama', 'LIKE', "%{$query}%")
            ->orWhere('nik_hash', $queryHash)
            ->get();
    }

    public function getByDusun(string $dusun): Collection
    {
        return $this->model->where('dusun', $dusun)->get();
    }

    protected function applyFilters($query, array $filters): \Illuminate\Database\Eloquent\Builder
    {
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $searchHash = hash_hmac('sha256', $search, config('app.key'));
            $query->where(function ($q) use ($search, $searchHash) {
                $q->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('nik_hash', $searchHash);
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query;
    }
}
