<?php

namespace App\Repositories\Interfaces;

use App\Models\Antrian;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface AntrianRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get quota usage for a specific date.
     * 
     * @param string $date
     * @return int
     */
    public function getQuotaCount(string $date): int;

    /**
     * Get the next sequence number for a date.
     * 
     * @param string $date
     * @return int
     */
    public function getNextNumber(string $date): int;

    /**
     * Find antrian by token.
     * 
     * @param string $token
     * @return Antrian|null
     */
    public function findByToken(string $token): ?Antrian;

    /**
     * Get currently serving antrian.
     * 
     * @return Antrian|null
     */
    public function getCurrentServing(): ?Antrian;

    /**
     * Get waiting antrian for today.
     * 
     * @return Collection
     */
    public function getTodayWaiting(): Collection;
}
