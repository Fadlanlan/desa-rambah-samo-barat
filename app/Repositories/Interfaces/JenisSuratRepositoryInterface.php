<?php

namespace App\Repositories\Interfaces;

use App\Models\JenisSurat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface JenisSuratRepositoryInterface extends BaseRepositoryInterface
{
    public function getActive(): Collection;

    /**
     * Get letter types ordered by specific column.
     *
     * @param string $column
     * @param string $direction
     * @return Collection
     */
    public function getAllOrdered(string $column = 'urutan', string $direction = 'asc'): Collection;
}
