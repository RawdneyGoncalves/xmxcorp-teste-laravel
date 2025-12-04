<?php

namespace App\Domain\Blog\DTO;

class ListPostsOutputDTO
{
    public function __construct(
        public array $posts,
        public int $currentPage,
        public int $perPage,
        public int $total,
        public int $lastPage,
        public array $allTags = []
    ) {}

    public function toArray(): array
    {
        return [
            'posts' => $this->posts,
            'currentPage' => $this->currentPage,
            'perPage' => $this->perPage,
            'total' => $this->total,
            'lastPage' => $this->lastPage,
            'allTags' => $this->allTags,
        ];
    }
}
