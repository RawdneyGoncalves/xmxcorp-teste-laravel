<?php

namespace App\Domain\Blog\Services;

use App\Domain\Blog\Entities\UserEntity;
use App\Domain\Blog\Repositories\UserRepositoryInterface;
use App\Domain\Blog\ValueObjects\UserId;

class UserDomainService
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function registerUser(UserEntity $user): void
    {
        $existingUser = $this->userRepository->findByEmail($user->getEmail()->getValue());

        if ($existingUser) {
            throw new \DomainException("Email ja cadastrado");
        }

        $this->userRepository->save($user);
    }

    public function updateUser(UserEntity $user): void
    {
        $existingUser = $this->userRepository->findById($user->getUserId());

        if (!$existingUser) {
            throw new \DomainException("Usuario nao encontrado");
        }

        $this->userRepository->save($user);
    }

    public function deleteUser(UserId $userId): void
    {
        $user = $this->userRepository->findById($userId);

        if (!$user) {
            throw new \DomainException("Usuario nao encontrado");
        }

        $this->userRepository->delete($userId);
    }

    public function getUserProfile(UserId $userId): ?UserEntity
    {
        return $this->userRepository->findById($userId);
    }

    public function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function calculateUserReputation(UserEntity $user): float
    {
        $now = new \DateTime();
        $accountAgeDays = (int) $user->getCreatedAt()->diff($now)->format('%d');

        if ($accountAgeDays === 0) {
            $accountAgeDays = 1;
        }

        $postsPerDay = 1 / $accountAgeDays;
        $reputationScore = ($postsPerDay * 10) * (1 + log($accountAgeDays + 1));

        return min($reputationScore, 100.0);
    }
}
