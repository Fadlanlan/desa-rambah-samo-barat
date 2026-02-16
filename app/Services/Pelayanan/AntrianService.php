<?php

namespace App\Services\Pelayanan;

use App\Repositories\Interfaces\AntrianRepositoryInterface;
use App\Models\Antrian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class AntrianService
{
    protected $antrianRepository;
    protected $maxQuota = 20; // Default daily quota

    public function __construct(AntrianRepositoryInterface $antrianRepository)
    {
        $this->antrianRepository = $antrianRepository;
    }

    /**
     * Book a new queue slot.
     */
    public function bookQueue(array $data): Antrian
    {
        $date = $data['tanggal_kunjungan'];

        // 1. Check Quota
        $currentCount = $this->antrianRepository->getQuotaCount($date);
        if ($currentCount >= $this->maxQuota) {
            throw new Exception("Kuota antrian untuk tanggal " . date('d-m-Y', strtotime($date)) . " sudah penuh.");
        }

        return DB::transaction(function () use ($data, $date) {
            // 2. Generate Number (e.g., A-001)
            $nextNum = $this->antrianRepository->getNextNumber($date);
            $formattedNum = 'A-' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

            // 3. Create Record
            return $this->antrianRepository->create(array_merge($data, [
                'nomor_antrian' => $formattedNum,
                'status' => 'menunggu'
            ]));
        });
    }

    /**
     * Call next visitor.
     */
    public function callNext(int $adminId): ?Antrian
    {
        return DB::transaction(function () use ($adminId) {
            $next = $this->antrianRepository->getTodayWaiting()->first();

            if (!$next) {
                return null;
            }

            // Update status to dipanggil
            return $this->antrianRepository->update($next->id, [
                'status' => 'dipanggil',
                'called_by' => $adminId,
                'called_at' => now()
            ]);
        });
    }

    /**
     * Complete current service.
     */
    public function completeService(int $id): Antrian
    {
        return $this->antrianRepository->update($id, [
            'status' => 'selesai'
        ]);
    }

    /**
     * Cancel queue.
     */
    public function cancelQueue(int $id): Antrian
    {
        return $this->antrianRepository->update($id, [
            'status' => 'batal'
        ]);
    }

    /**
     * Get current status for a specific ticket.
     */
    public function getStatusByToken(string $token): ?Antrian
    {
        return $this->antrianRepository->findByToken($token);
    }

    /**
     * Get paginated queue list for admin.
     */
    public function getQueueList(int $perPage = 15, array $filters = [])
    {
        return $this->antrianRepository->getPaginated($perPage, $filters);
    }

    /**
     * Get dashboard stats.
     */
    public function getDashboardStats(): array
    {
        $today = now()->toDateString();
        return [
            'total_today' => $this->antrianRepository->getQuotaCount($today),
            'waiting' => $this->antrianRepository->getTodayWaiting()->count(),
            'current' => $this->antrianRepository->getCurrentServing(),
        ];
    }
}
