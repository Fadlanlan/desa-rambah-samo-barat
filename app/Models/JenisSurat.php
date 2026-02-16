<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisSurat extends Model
{
    /** @use HasFactory<\Database\Factories\JenisSuratFactory> */
    use HasFactory;

    protected $table = 'jenis_surat';

    protected $fillable = [
        'nama', 'kode', 'template', 'persyaratan',
        'keterangan', 'is_active', 'urutan'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    public function surat(): HasMany
    {
        return $this->hasMany(Surat::class);
    }
}
