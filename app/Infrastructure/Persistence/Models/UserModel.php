<?php

namespace App\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserModel extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'external_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'image',
        'birth_date',
        'address',
    ];

    protected $casts = [
        'address' => 'json',
        'birth_date' => 'date',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(PostModel::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(CommentModel::class, 'user_id');
    }

    public function scopeByExternalId($query, int $id)
    {
        return $query->where('external_id', $id);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
