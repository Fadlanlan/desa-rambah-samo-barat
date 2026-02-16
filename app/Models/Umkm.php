<?php

namespace App\Models;

use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Umkm extends Model
{
    /** @use HasFactory<\Database\Factories\UmkmFactory> */
    use HasFactory, SoftDeletes, HasAuditTrail;

    protected $table = 'umkm';

    protected $fillable = [
        'user_id', 'nama_usaha', 'pemilik', 'deskripsi',
        'kategori', 'alamat', 'telepon', 'email',
        'foto', 'website', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
