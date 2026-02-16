<?php

namespace App\Models;

use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Antrian extends Model
{
    use HasFactory, SoftDeletes, HasAuditTrail;

    protected $table = 'antrian';

    protected $fillable = [
        'uuid', 'nomor_antrian', 'nama_pengunjung', 'nik_pengunjung', 'penduduk_id',
        'kontak_pengunjung', 'keperluan', 'tanggal_kunjungan', 'jam_kunjungan',
        'status', 'token_akses', 'catatan', 'called_by', 'called_at'
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
        'called_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string)Str::uuid();
            }
            if (empty($model->token_akses)) {
                $model->token_akses = Str::random(40);
            }
        });
    }

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function caller(): BelongsTo
    {
        return $this->belongsTo(User::class , 'called_by');
    }
}
