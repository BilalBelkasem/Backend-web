<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    protected $fillable = [
        'title', 'image', 'content', 'published_at', 'user_id'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    // relatie met user (admin die het nieuws heeft gemaakt)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // many-to-many tags voor nieuws
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'news_tag')->withTimestamps();
    }
}
