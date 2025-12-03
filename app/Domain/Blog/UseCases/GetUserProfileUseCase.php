<?php

namespace App\Application\Blog\UseCases;

use App\Application\Blog\DTO\UserProfileOutputDTO;
use App\Application\Blog\Mappers\PostMapper;
use App\Application\Blog\Mappers\UserMapper;
use App\Domain\Blog\Repositories\UserRepositoryInterface;
use App\Application\Shared\Exceptions\EntityNotFoundException;
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
