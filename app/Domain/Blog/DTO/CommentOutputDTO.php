<?php

namespace App\Application\Blog\DTO;

final class CommentOutputDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $externalId,
        public readonly string $body,
        public readonly int $likes,
        public readonly UserOutputDTO $author,
        public readonly string $createdAt,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'externalId' => $this->externalId,
            'body' => $this->body,
            'likes' => $this->likes,
            'author' => $this->author->toArray(),
            'createdAt' => $this->createdAt,
        ];
    }
}
