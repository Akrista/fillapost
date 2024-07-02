<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialMediaService extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_media_type_id',
        'name',
        'token',
        'client_id',
        'client_secret',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function socialMediaType(): BelongsTo
    {
        return $this->belongsTo(SocialMediaType::class);
    }

    public function serviceAccount(): HasMany
    {
        return $this->hasMany(ServiceAccount::class);
    }
}
