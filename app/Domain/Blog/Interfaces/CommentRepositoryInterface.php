<?php

namespace App\Domain\Blog\Interfaces;

use App\Domain\Blog\Shared\Entities\CommentEntity;
use App\Domain\Blog\ValueObjects\PostId;

interface CommentRepositoryInterface
{
    public function findById(int $commentId): ?CommentEntity;
    public function findByExternalId(int $externalId): ?CommentEntity;
    public function findByPostId(PostId $postId, int $page = 1, int $perPage = 30): array;
    public function findAll(int $page = 1, int $perPage = 30): array;
    public function save(CommentEntity $comment): void;
    public function delete(int $commentId): void;
    public function countByPostId(PostId $postId): int;
}
