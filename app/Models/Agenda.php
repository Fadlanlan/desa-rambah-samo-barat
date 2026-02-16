<?php

namespace App\Models;

use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agenda extends Model
{
    /** @use HasFactory<\Database\Factories\AgendaFactory> */
    use HasFactory, SoftDeletes, HasAuditTrail;

    protected $table = 'agenda';

    protected $fillable = [
        'user_id', 'judul', 'deskripsi', 'tanggal_mulai',
        'tanggal_selesai', 'lokasi', 'penyelenggara',
        'kategori', 'is_active'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
