<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'status',
        'internal_id',
        'scheduled_at',
        'published_at',
        'user_id',
        'service_account_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function serviceAccount(): BelongsTo
    {
        return $this->belongsTo(ServiceAccount::class);
    }
}
