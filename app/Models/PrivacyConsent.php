<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivacyConsent extends Model
{
    /** @use HasFactory<\Database\Factories\PrivacyConsentFactory> */
    use HasFactory;

    protected $table = 'privacy_consents';

    protected $fillable = [
        'user_id', 'consent_type', 'accepted',
        'accepted_at', 'ip_address', 'user_agent'
    ];

    protected $casts = [
        'accepted' => 'boolean',
        'accepted_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
