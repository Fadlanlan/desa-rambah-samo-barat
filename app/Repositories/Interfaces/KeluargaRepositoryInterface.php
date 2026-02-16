<?php

namespace App\Repositories\Interfaces;

interface KeluargaRepositoryInterface extends BaseRepositoryInterface
{
    public function findByNoKk(string $noKk);
}
