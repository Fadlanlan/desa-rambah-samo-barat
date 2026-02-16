<?php

namespace App\Repositories\Interfaces;

interface PendudukRepositoryInterface extends BaseRepositoryInterface
{
    public function getByDusun(string $dusun);
}
