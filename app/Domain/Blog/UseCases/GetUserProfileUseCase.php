<?php

namespace App\Domain\Blog\UseCases;

use App\Domain\Blog\DTO\UserProfileOutputDTO;
use App\Domain\Blog\Mappers\PostMapper;
use App\Domain\Blog\Mappers\UserMapper;
use App\Domain\Blog\Interfaces\UserRepositoryInterface;
use App\Domain\Shared\Exceptions\EntityNotFoundException;
use App\Infrastructure\Persistence\Models\UserModel;

class GetUserProfileUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function execute(int $externalUserId): UserProfileOutputDTO
    {
        $user = $this->userRepository->findByExternalId($externalUserId);

        if (!$user) {
            throw new EntityNotFoundException("Usuario nao encontrado");
        }

        $userModel = UserModel::query()->where('external_id', $externalUserId)->first();

        $user = UserMapper::fromModelToDTO($userModel);

        $posts = [];
        foreach ($userModel->posts as $postModel) {
            $posts[] = PostMapper::fromModelToDTO($postModel, $postModel->comments->count());
        }

        return new UserProfileOutputDTO(
            user: $user,
            posts: $posts,
            totalPosts: count($posts),
        );
    }
}
