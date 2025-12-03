<?php

namespace App\Application\Blog\DTO;

final class ListPostsOutputDTO
{
    public function __construct(
        public readonly array $posts,
        public readonly int $currentPage,
        public readonly int $perPage,
        public readonly int $total,
        public readonly int $lastPage,
        public readonly ?array $allTags = null,
    ) {}

    public function toArray(): array
    {
        return [
            'posts' => array_map(fn(PostOutputDTO $post) => $post->toArray(), $this->posts),
            'pagination' => [
                'currentPage' => $this->currentPage,
                'perPage' => $this->perPage,
                'total' => $this->total,
                'lastPage' => $this->lastPage,
            ],
            'allTags' => $this->allTags,
        ];
    }
}
