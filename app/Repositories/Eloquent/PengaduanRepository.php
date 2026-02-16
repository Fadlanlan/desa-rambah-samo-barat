<?php

namespace App\Repositories\Eloquent;

use App\Models\Pengaduan;
use App\Repositories\Interfaces\PengaduanRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PengaduanRepository extends BaseRepository implements PengaduanRepositoryInterface
{
    public function __construct(Pengaduan $model)
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
        return $this->model->with(['penduduk', 'handler'])->find($id);
    }

    public function findByIdOrFail(int $id): Model
    {
        return $this->model->with(['penduduk', 'handler'])->findOrFail($id);
    }

    public function getPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->with(['penduduk', 'handler'])->latest();
        $this->applyFilters($query, $filters);
        return $query->paginate($perPage);
    }

    public function getByStatus(string $status, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->where('status', $status)
            ->with(['penduduk', 'handler'])
            ->latest()
            ->paginate($perPage);
    }

    public function findByTicketNumber(string $ticketNumber): ?Pengaduan
    {
        return $this->model->where('nomor_tiket', $ticketNumber)
            ->with(['penduduk', 'handler'])
            ->first();
    }

    public function getByCategory(string $category, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->where('kategori', $category)
            ->with(['penduduk', 'handler'])
            ->latest()
            ->paginate($perPage);
    }

    protected function applyFilters(Builder $query, array $filters): Builder
    {
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['kategori'])) {
            $query->where('kategori', $filters['kategori']);
        }

        if (!empty($filters['prioritas'])) {
            $query->where('prioritas', $filters['prioritas']);
        }

        if (!empty($filters['search'])) {
            $search = (string)$filters['search'];
            return $query->where(function (Builder $q) use ($search) {
                return $q->where('nomor_tiket', 'like', '%' . $search . '%')
                    ->orWhere('judul', 'like', '%' . $search . '%')
                    ->orWhere('nama_pelapor', 'like', '%' . $search . '%');
            });
        }

        return $query;
    }
}
