<?php

namespace App\Domain\Blog\Interfaces;

use DateTime;
use App\Domain\Blog\Entities\PostEntity;
use App\Domain\Blog\ValueObjects\PostId;
use App\Domain\Blog\ValueObjects\UserId;

interface PostRepositoryInterface
{
    public function findById(PostId $postId): ?PostEntity;

    public function findByExternalId(int $externalId): ?PostEntity;

    public function findByUserId(UserId $userId, int $page = 1, int $perPage = 30): array;

    public function findAll(int $page = 1, int $perPage = 30): array;

    public function findByTag(string $tag, int $page = 1, int $perPage = 30): array;

    public function searchByTitle(string $title, int $page = 1, int $perPage = 30): array;

    public function findByMinLikes(int $minLikes, int $page = 1, int $perPage = 30): array;

    public function findByDateRange(DateTime $from, ?DateTime $to = null, int $page = 1, int $perPage = 30): array;

    public function save(PostEntity $post): void;

    public function delete(PostId $postId): void;

    public function count(): int;

    public function countByUserId(UserId $userId): int;
}
