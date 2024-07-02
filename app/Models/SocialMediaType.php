<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialMediaType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type',
    ];

    public function socialMediaServices(): HasMany
    {
        return $this->hasMany(SocialMediaService::class);
    }
}
