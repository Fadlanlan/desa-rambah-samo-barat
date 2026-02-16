<?php

namespace App\Models;

use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    /** @use HasFactory<\Database\Factories\PengaduanFactory> */
    use HasFactory, SoftDeletes, HasAuditTrail;

    protected $table = 'pengaduan';

    protected $fillable = [
        'nomor_tiket', 'penduduk_id', 'nama_pelapor', 'kontak_pelapor',
        'kategori', 'judul', 'isi', 'bukti', 'prioritas', 'status',
        'balasan', 'handled_by', 'responded_at', 'resolved_at'
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class , 'handled_by');
    }
}
