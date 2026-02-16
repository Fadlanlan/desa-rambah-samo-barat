<?php

namespace App\Services\Pelayanan;

use App\Repositories\Interfaces\SuratRepositoryInterface;
use App\Models\LogSurat;
use App\Models\Surat;
use App\Services\BaseService;
use App\Utils\LetterNumberingUtility;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SuratService extends BaseService
{
    public function __construct(SuratRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Submit a new letter request.
     */
    public function submitRequest(array $data): Surat
    {
        return DB::transaction(function () use ($data) {
            $data['status'] = 'diajukan'; // Default from user spec (diajukan/menunggu)
            $data['uuid'] = (string)Str::uuid();
            $data['tanggal_pengajuan'] = now();

            $surat = $this->repository->create($data);

            LogSurat::create([
                'surat_id' => $surat->id,
                'aksi' => 'pengajuan',
                'keterangan' => 'Permohonan surat baru diajukan oleh sistem/operator.',
            ]);

            return $surat;
        });
    }

    /**
     * Process a letter and assign a formal number.
     * Uses lockForUpdate to prevent race conditions.
     */
    public function process(int $id, int $processorId): Surat
    {
        return DB::transaction(function () use ($id, $processorId) {
            /** @var Surat $surat */
            $surat = $this->repository->findByIdOrFail($id);

            if ($surat->status !== 'diajukan' && $surat->status !== 'draft') {
                throw new \Exception('Surat tidak berada dalam status yang dapat diproses.');
            }

            $now = Carbon::now();

            // Get sequence with Lock
            $sequence = $this->repository->getLastSequenceNumber($surat->jenis_surat_id, $now->year, $now->month) + 1;

            $nomorSurat = LetterNumberingUtility::generateNumber(
                $sequence,
                $surat->jenisSurat->kode,
                $now
            );

            // Generate Verification Hash
            $hash = LetterNumberingUtility::generateHash($nomorSurat, $surat->penduduk_id, $now->toDateTimeString());

            $surat->update([
                'status' => 'diproses',
                'user_id' => $processorId,
                'approved_by' => $processorId,
                'nomor_surat' => $nomorSurat,
                'hash_verifikasi' => $hash,
                'tanggal_disetujui' => $now,
            ]);

            // Auto-generate PDF and save the path
            $pdfContent = $this->generatePdf($surat->id)->output();
            $filename = 'surat/' . str_replace(['/', '\\'], '-', $nomorSurat) . '_' . $surat->uuid . '.pdf';
            Storage::disk('public')->put($filename, $pdfContent);

            $surat->update(['file_pdf' => $filename]);

            LogSurat::create([
                'surat_id' => $surat->id,
                'aksi' => 'disetujui',
                'user_id' => $processorId,
                'keterangan' => "Surat disetujui dan nomor surat {$nomorSurat} diberikan.",
            ]);

            return $surat->fresh();
        });
    }

    /**
     * Mark a letter as rejected.
     */
    public function reject(int $id, string $reason, int $userId): bool
    {
        return DB::transaction(function () use ($id, $reason, $userId) {
            $updated = $this->repository->update($id, [
                'status' => 'ditolak',
                'alasan_penolakan' => $reason,
                'rejected_by' => $userId
            ]);

            LogSurat::create([
                'surat_id' => $id,
                'aksi' => 'ditolak',
                'user_id' => $userId,
                'keterangan' => "Permohonan ditolak dengan alasan: {$reason}",
            ]);

            return (bool)$updated;
        });
    }

    /**
     * Mark a letter as finished.
     */
    public function finish(int $id, int $userId): bool
    {
        return DB::transaction(function () use ($id, $userId) {
            $updated = $this->repository->update($id, [
                'status' => 'selesai'
            ]);

            LogSurat::create([
                'surat_id' => $id,
                'aksi' => 'selesai',
                'user_id' => $userId,
                'keterangan' => 'Surat ditandai sebagai selesai/sudah diambil/diserahkan.',
            ]);

            return (bool)$updated;
        });
    }

    /**
     * Generate PDF for the letter.
     */
    public function generatePdf(int $id)
    {
        /** @var Surat $surat */
        $surat = $this->repository->findByIdOrFail($id);

        $verificationUrl = route('surat.verify', $surat->uuid);

        // QR Code in SVG format (doesn't require Imagick/image processing extensions)
        $qrCode = QrCode::format('svg')
            ->size(80)
            ->errorCorrection('H')
            ->generate($verificationUrl);

        $pdf = Pdf::loadView('pdf.standard_letter', compact('surat', 'qrCode'));

        return $pdf;
    }

    /**
     * Get stats for dashboard.
     */
    public function getDashboardStats(): array
    {
        return $this->repository->getStats();
    }
}
