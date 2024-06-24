<?php

namespace App\Models;

use AnourValar\EloquentSerialize\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialMediaService extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'token',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function serviceAccount(): HasMany
    {
        return $this->hasMany(ServiceAccount::class);
    }
}
