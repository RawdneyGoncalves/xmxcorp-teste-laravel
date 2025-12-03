<?php

namespace App\Application\Blog\DTO;

final class PostDetailOutputDTO
{
    public function __construct(
        public readonly PostOutputDTO $post,
        public readonly array $comments,
    ) {}

    public function toArray(): array
    {
        return [
            'post' => $this->post->toArray(),
            'comments' => array_map(fn(CommentOutputDTO $comment) => $comment->toArray(), $this->comments),
        ];
    }
}
