<?php

namespace App\Models;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceAccount extends Model implements HasAvatar
{
    use HasFactory;

    protected $fillable = [
        'social_media_service_id',
        'name',
        'avatar',
        'internal_id',
    ];

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function socialMediaService(): BelongsTo
    {
        return $this->belongsTo(SocialMediaService::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
