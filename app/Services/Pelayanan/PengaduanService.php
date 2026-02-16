<?php

namespace App\Services\Pelayanan;

use App\Repositories\Interfaces\PengaduanRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengaduanService
{
    protected $repository;

    public function __construct(PengaduanRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function paginateAdmin(array $filters = [], int $perPage = 15)
    {
        return $this->repository->getPaginated($perPage, $filters);
    }

    public function findById(int $id)
    {
        return $this->repository->findByIdOrFail($id);
    }

    public function submitComplaint(array $data)
    {
        $data['nomor_tiket'] = $this->generateTicketNumber();
        $data['status'] = 'baru';

        if (isset($data['bukti_file']) && $data['bukti_file']->isValid()) {
            $path = $data['bukti_file']->store('pengaduan/bukti', 'public');
            $data['bukti'] = $path;
        }

        // If authenticated, link to resident
        if (Auth::guard('web')->check()) {
            $user = Auth::user();
        // Assuming user has nik or is associated with a resident record
        // For now, if we have a way to match NIK, we do it.
        }

        return $this->repository->create($data);
    }

    public function process(int $id)
    {
        return $this->repository->update($id, [
            'status' => 'diproses',
            'handled_by' => Auth::id(),
            'responded_at' => now(),
        ]);
    }

    public function reply(int $id, string $replyContent, string $status = 'selesai')
    {
        $updateData = [
            'balasan' => $replyContent,
            'status' => $status,
            'handled_by' => Auth::id(),
            'responded_at' => now(),
        ];

        if ($status === 'selesai') {
            $updateData['resolved_at'] = now();
        }

        return $this->repository->update($id, $updateData);
    }

    protected function generateTicketNumber(): string
    {
        $prefix = 'TKT-' . date('Ymd');
        $random = strtoupper(Str::random(4));

        $number = $prefix . '-' . $random;

        // Ensure uniqueness
        while ($this->repository->findByTicketNumber($number)) {
            $random = strtoupper(Str::random(4));
            $number = $prefix . '-' . $random;
        }

        return $number;
    }
}
