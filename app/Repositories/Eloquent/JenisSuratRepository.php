<?php

namespace App\Repositories\Eloquent;

use App\Models\JenisSurat;
use App\Repositories\Interfaces\JenisSuratRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class JenisSuratRepository extends BaseRepository implements JenisSuratRepositoryInterface
{
    public function __construct(JenisSurat $model)
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
        return $this->model->find($id);
    }

    // JenisSurat does not have UUID in current migration. Removing findByUuid for now.

    public function getPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();
        $this->applyFilters($query, $filters);
        return $query->paginate($perPage);
    }

    public function update(int $id, array $newDetails): Model
    {
        /** @var \App\Models\JenisSurat $record */
        $record = $this->model->findOrFail($id);
        $record->update($newDetails);

        return $record->fresh();
    }

    public function getActive(): Collection
    {
        return $this->model->where('is_active', true)->orderBy('urutan')->get();
    }

    public function getAllOrdered(string $column = 'urutan', string $direction = 'asc'): Collection
    {
        return $this->model->orderBy($column, $direction)->get();
    }

    protected function applyFilters(Builder $query, array $filters): Builder
    {
        if (!empty($filters['search'])) {
            $search = (string)$filters['search'];
            return $query->where(function (Builder $q) use ($search) {
                return $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('kode', 'like', '%' . $search . '%');
            });
        }

        if (isset($filters['active'])) {
            $query->where('is_active', (bool)$filters['active']);
        }

        return $query;
    }
}
