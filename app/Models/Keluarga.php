<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasEncryptedFields;
use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keluarga extends Model
{
    use SoftDeletes, HasEncryptedFields, HasAuditTrail;

    protected $table = 'keluarga';

    protected $fillable = [
        'no_kk',
        'no_kk_hash',
        'kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'created_by',
        'updated_by'
    ];

    protected $encryptedFields = [
        'no_kk'
    ];

    public function anggota(): HasMany
    {
        return $this->hasMany(Penduduk::class , 'keluarga_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class , 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class , 'updated_by');
    }
}
