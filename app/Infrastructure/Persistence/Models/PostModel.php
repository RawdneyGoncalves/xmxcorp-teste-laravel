<?php

namespace App\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostModel extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'external_id',
        'user_id',
        'title',
        'body',
        'tags',
        'likes',
        'dislikes',
        'views',
    ];

    protected $casts = [
        'tags' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(CommentModel::class, 'post_id');
    }

    public function scopeByExternalId($query, int $id)
    {
        return $query->where('external_id', $id);
    }

    public function scopeByTag($query, string $tag)
    {
        return $query->whereJsonContains('tags', $tag);
    }

    public function scopeByMinLikes($query, int $minLikes)
    {
        return $query->where('likes', '>=', $minLikes);
    }

    public function scopeByUserWithFilters($query, int $userId, ?string $tag = null, ?string $search = null)
    {
        $query->where('user_id', $userId);

        if ($tag) {
            $query->whereJsonContains('tags', $tag);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        return $query;
    }
}
