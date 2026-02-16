<?php

namespace App\Repositories\Interfaces;

use App\Models\Pengaduan;
use Illuminate\Pagination\LengthAwarePaginator;

interface PengaduanRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get complaints by status.
     *
     * @param string $status
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getByStatus(string $status, int $perPage = 15): LengthAwarePaginator;

    /**
     * Find complaint by ticket number.
     *
     * @param string $ticketNumber
     * @return Pengaduan|null
     */
    public function findByTicketNumber(string $ticketNumber): ?Pengaduan;

    /**
     * Get complaints by category.
     *
     * @param string $category
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getByCategory(string $category, int $perPage = 15): LengthAwarePaginator;
}
