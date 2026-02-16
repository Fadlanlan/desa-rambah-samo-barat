<?php

namespace App\Repositories\Interfaces;

interface BeritaRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug(string $slug);
    public function getPublished(int $perPage = 10, array $filters = []);
    public function getFeatured(int $limit = 5);
}
