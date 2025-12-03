<?php

namespace App\Application\Blog\DTO;

final class PostOutputDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $externalId,
        public readonly string $title,
        public readonly string $body,
        public readonly array $tags,
        public readonly int $likes,
        public readonly int $dislikes,
        public readonly int $views,
        public readonly int $commentCount,
        public readonly UserOutputDTO $author,
        public readonly string $createdAt,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'externalId' => $this->externalId,
            'title' => $this->title,
            'body' => $this->body,
            'tags' => $this->tags,
            'likes' => $this->likes,
            'dislikes' => $this->dislikes,
            'views' => $this->views,
            'commentCount' => $this->commentCount,
            'author' => $this->author->toArray(),
            'createdAt' => $this->createdAt,
        ];
    }
}
