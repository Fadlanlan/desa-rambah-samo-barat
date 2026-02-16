<?php

namespace App\Repositories\Eloquent;

use App\Models\Berita;
use App\Repositories\Interfaces\BeritaRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BeritaRepository extends BaseRepository implements BeritaRepositoryInterface
{
    public function __construct(Berita $model)
    {
        parent::__construct($model);
    }

    public function findById(int $id): ?Model
    {
        return $this->model->with(['penulis', 'category'])->find($id);
    }

    public function getAll(array $filters = []): \Illuminate\Database\Eloquent\Collection
    {
        $query = $this->model->with(['penulis', 'category'])->latest();
        $this->applyFilters($query, $filters);
        return $query->get();
    }

    public function getPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->with(['penulis', 'category'])->latest();
        $this->applyFilters($query, $filters);
        return $query->paginate($perPage);
    }

    protected function applyFilters(Builder $query, array $filters): Builder
    {
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where('judul', 'LIKE', "%{$search}%");
        }

        return $query;
    }

    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)
            ->with(['penulis', 'category'])
            ->first();
    }

    public function getPublished(int $perPage = 10, array $filters = [])
    {
        $query = $this->model->where('is_published', true)
            ->with(['penulis', 'category'])
            ->latest('published_at');

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where('judul', 'LIKE', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    public function getFeatured(int $limit = 5)
    {
        return $this->model->where('is_published', true)
            ->where('is_featured', true)
            ->with(['penulis', 'category'])
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }
}
