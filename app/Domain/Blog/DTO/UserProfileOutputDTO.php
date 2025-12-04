<?php

namespace App\Domain\Blog\DTO;

final class UserProfileOutputDTO
{
    public function __construct(
        public readonly UserOutputDTO $user,
        public readonly array $posts,
        public readonly int $totalPosts,
    ) {}

    public function toArray(): array
    {
        return [
            'user' => $this->user->toArray(),
            'posts' => array_map(fn(PostOutputDTO $post) => $post->toArray(), $this->posts),
            'totalPosts' => $this->totalPosts,
        ];
    }
}
