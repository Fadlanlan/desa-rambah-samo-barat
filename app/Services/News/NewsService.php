<?php

namespace App\Services\News;

use App\Repositories\Interfaces\BeritaRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsService
{
    protected $beritaRepository;

    public function __construct(BeritaRepositoryInterface $beritaRepository)
    {
        $this->beritaRepository = $beritaRepository;
    }

    public function getPublishedNews(int $perPage = 10, array $filters = [])
    {
        return $this->beritaRepository->getPublished($perPage, $filters);
    }

    public function getFeaturedNews(int $limit = 5)
    {
        return $this->beritaRepository->getFeatured($limit);
    }

    public function getNewsDetail(string $slug)
    {
        return $this->beritaRepository->findBySlug($slug);
    }

    public function createNews(array $data)
    {
        if (empty($data['slug']) && !empty($data['judul'])) {
            $data['slug'] = Str::slug($data['judul']);
        }

        try {
            return $this->beritaRepository->create($data);
        }
        catch (\Exception $e) {
            Log::error("Error creating news: " . $e->getMessage());
            throw $e;
        }
    }

    public function updateNews(int $id, array $data)
    {
        if (!empty($data['judul']) && empty($data['slug'])) {
            $data['slug'] = Str::slug($data['judul']);
        }

        try {
            return $this->beritaRepository->update($id, $data);
        }
        catch (\Exception $e) {
            Log::error("Error updating news (ID {$id}): " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteNews(int $id)
    {
        try {
            return $this->beritaRepository->delete($id);
        }
        catch (\Exception $e) {
            Log::error("Error deleting news (ID {$id}): " . $e->getMessage());
            throw $e;
        }
    }
}
