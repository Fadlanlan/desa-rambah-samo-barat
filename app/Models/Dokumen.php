<?php

namespace App\Models;

use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumen extends Model
{
    /** @use HasFactory<\Database\Factories\DokumenFactory> */
    use HasFactory, SoftDeletes, HasAuditTrail;

    protected $table = 'dokumen';

    protected $fillable = [
        'user_id', 'judul', 'deskripsi', 'file_path',
        'file_name', 'file_type', 'file_size',
        'kategori', 'is_public', 'download_count'
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'file_size' => 'integer',
        'download_count' => 'integer',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
