<?php

namespace App\Services\Pelayanan;

use App\Repositories\Interfaces\JenisSuratRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;

class JenisSuratService extends BaseService
{
    public function __construct(JenisSuratRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get active letter types for public or operator use.
     */
    public function getActiveList(): Collection
    {
        return $this->repository->getActive();
    }

    /**
     * Get all ordered for admin management.
     */
    public function getAdminList(): Collection
    {
        return $this->repository->getAllOrdered();
    }
}
