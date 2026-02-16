<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    public function getAll(array $filters = []): Collection;
    public function findById(int $id): ?Model;
    public function findByIdOrFail(int $id): Model;
    public function findByUuid(string $uuid): ?Model;
    public function getPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator;
    public function create(array $details): Model;
    public function update(int $id, array $newDetails): Model;
    public function delete(int $id): bool;
}
