<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogSurat extends Model
{
    use HasFactory;

    protected $table = 'log_surat';

    protected $fillable = [
        'surat_id',
        'aksi',
        'user_id',
        'ip_address',
        'keterangan',
    ];

    public function surat(): BelongsTo
    {
        return $this->belongsTo(Surat::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
