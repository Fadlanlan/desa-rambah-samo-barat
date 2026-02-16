<?php

namespace App\Repositories\Eloquent;

use App\Models\Keluarga;
use App\Repositories\Interfaces\KeluargaRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class KeluargaRepository extends BaseRepository implements KeluargaRepositoryInterface
{
    public function __construct(Keluarga $model)
    {
        parent::__construct($model);
    }

    public function findById(int $id): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->model->with(['anggota'])->find($id); // Changed penduduk to anggota, removed kepalaKeluarga
    }

    public function getPaginated(int $perPage = 15, array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->model->newQuery(); // Removed with(['kepalaKeluarga'])
        $this->applyFilters($query, $filters);
        return $query->paginate($perPage);
    }

    public function getAll(array $filters = []): \Illuminate\Database\Eloquent\Collection
    {
        $query = $this->model->newQuery(); // Removed with(['kepalaKeluarga'])
        $this->applyFilters($query, $filters);
        return $query->get();
    }

    public function findByNoKk(string $noKk)
    {
        return $this->model->where('no_kk', $noKk)->first();
    }

    protected function applyFilters($query, array $filters): \Illuminate\Database\Eloquent\Builder
    {
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('no_kk', 'LIKE', "%{$search}%")
                    ->orWhere('alamat', 'LIKE', "%{$search}%");
            });
        }

        if (!empty($filters['dusun'])) {
            $query->where('dusun', $filters['dusun']);
        }

        return $query;
    }
}
