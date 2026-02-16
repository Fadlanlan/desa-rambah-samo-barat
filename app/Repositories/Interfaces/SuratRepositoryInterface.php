<?php

namespace App\Repositories\Interfaces;

use App\Models\Surat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface SuratRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get letters by status.
     */
    public function getByStatus(string $status, int $perPage = 15): LengthAwarePaginator;

    /**
     * Get letters for a specific resident.
     */
    public function getByPenduduk(int $pendudukId): Collection;

    /**
     * Get the latest sequence number for a letter type in a given year/month.
     */
    public function getLastSequenceNumber(int $jenisSuratId, int $year, int $month = null): int;

    /**
     * Get surat statistics for dashboard.
     */
    public function getStats(): array;
}
