<?php

namespace App\Domain\Blog\Interfaces;

use App\Domain\Blog\Entities\UserEntity;
use App\Domain\Blog\ValueObjects\UserId;

interface UserRepositoryInterface
{
    public function findById(UserId $userId): ?UserEntity;

    public function findByExternalId(int $externalId): ?UserEntity;

    public function findAll(int $page = 1, int $perPage = 30): array;

    public function findByEmail(string $email): ?UserEntity;

    public function save(UserEntity $user): void;

    public function delete(UserId $userId): void;

    public function count(): int;
}
