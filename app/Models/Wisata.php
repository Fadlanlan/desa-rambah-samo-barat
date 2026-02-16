<?php

namespace App\Models;

use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Wisata extends Model
{
    use HasFactory, SoftDeletes, HasAuditTrail;

    protected $table = 'wisata';

    protected $fillable = [
        'uuid',
        'nama',
        'slug',
        'deskripsi',
        'lokasi',
        'harga_tiket',
        'jam_operasional',
        'kontak',
        'gambar',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string)Str::uuid();
            if (!$model->slug) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }
}
