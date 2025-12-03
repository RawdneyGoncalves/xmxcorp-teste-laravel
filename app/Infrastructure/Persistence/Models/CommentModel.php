<?php

namespace App\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentModel extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'post_id',
        'user_id',
        'body',
        'likes',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(PostModel::class, 'post_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function scopeByPostId($query, int $postId)
    {
        return $query->where('post_id', $postId);
    }
}
