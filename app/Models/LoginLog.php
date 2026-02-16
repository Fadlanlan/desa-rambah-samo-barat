<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginLog extends Model
{
    /** @use HasFactory<\Database\Factories\LoginLogFactory> */
    use HasFactory;

    protected $table = 'login_logs';

    public $timestamps = false; // Custom timestamp managed manually if needed, but table has login_at

    protected $fillable = [
        'user_id', 'email', 'ip_address', 'user_agent',
        'status', 'login_at'
    ];

    protected $casts = [
        'login_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
