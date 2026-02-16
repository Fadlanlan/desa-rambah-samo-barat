<?php

namespace App\Models;

use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    /** @use HasFactory<\Database\Factories\GaleriFactory> */
    use HasFactory, SoftDeletes, HasAuditTrail;

    protected $table = 'galeri';

    protected $fillable = [
        'user_id', 'judul', 'deskripsi', 'file_path',
        'tipe', 'kategori', 'urutan', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
