<?php

namespace App\Models;

use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apbdes extends Model
{
    /** @use HasFactory<\Database\Factories\ApbdesFactory> */
    use HasFactory, HasAuditTrail;

    protected $table = 'apbdes';

    protected $fillable = [
        'user_id', 'tahun_anggaran', 'jenis', 'kategori',
        'sub_kategori', 'uraian', 'anggaran', 'realisasi',
        'sumber_dana', 'keterangan'
    ];

    protected $casts = [
        'anggaran' => 'decimal:2',
        'realisasi' => 'decimal:2',
        'tahun_anggaran' => 'integer',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
