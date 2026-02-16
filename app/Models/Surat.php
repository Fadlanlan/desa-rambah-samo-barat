<?php

namespace App\Models;

use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Surat extends Model
{
    /** @use HasFactory<\Database\Factories\SuratFactory> */
    use HasFactory, SoftDeletes, HasAuditTrail;

    protected $table = 'surat';

    protected $fillable = [
        'uuid', 'nomor_surat', 'jenis_surat_id', 'penduduk_id', 'user_id',
        'data_surat', 'keterangan', 'keperluan', 'status', 'alasan_penolakan',
        'approved_by', 'rejected_by', 'tanggal_pengajuan', 'tanggal_disetujui',
        'qr_token', 'file_pdf', 'hash_verifikasi',
        'ditandatangani_oleh', 'ditandatangani_at'
    ];

    protected $casts = [
        'data_surat' => 'array',
        'ditandatangani_at' => 'datetime',
        'tanggal_pengajuan' => 'datetime',
        'tanggal_disetujui' => 'datetime',
    ];

    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class , 'approved_by');
    }

    public function rejector(): BelongsTo
    {
        return $this->belongsTo(User::class , 'rejected_by');
    }

    public function logSurat(): HasMany
    {
        return $this->hasMany(LogSurat::class)->latest();
    }
}
