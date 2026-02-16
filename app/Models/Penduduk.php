<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasEncryptedFields;
use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penduduk extends Model
{
    use HasFactory, SoftDeletes, HasEncryptedFields, HasAuditTrail;

    protected $table = 'penduduk';

    protected $fillable = [
        'keluarga_id',
        'nik',
        'nik_hash',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan_terakhir',
        'kewarganegaraan',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'golongan_darah',
        'no_hp',
        'foto',
        'status_hubungan',
        'status',
        'catatan',
        'created_by',
        'updated_by'
    ];

    protected $encryptedFields = [
        'nik',
        'no_hp'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(Keluarga::class , 'keluarga_id');
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
