<?php

namespace App\Domain\Blog\UseCases;

use App\Domain\Blog\DTO\ListPostsInputDTO;
use App\Domain\Blog\DTO\ListPostsOutputDTO;
use App\Domain\Blog\Mappers\PostMapper;
use App\Domain\Blog\Interfaces\PostRepositoryInterface;
use App\Domain\Blog\Interfaces\UserRepositoryInterface;
use App\Application\Shared\Exceptions\EntityNotFoundException;
use App\Infrastructure\Persistence\Models\UserModel;

class ListUserPostsUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PostRepositoryInterface $postRepository,
    ) {}

    public function execute(int $externalUserId, ListPostsInputDTO $input): ListPostsOutputDTO
    {
        $user = $this->userRepository->findByExternalId($externalUserId);

        if (!$user) {
            throw new EntityNotFoundException("Usuario nao encontrado");
        }

        $userModel = UserModel::query()->where('external_id', $externalUserId)->first();
        $userId = $user->getUserId();

        $posts = [];
        $allTags = [];

        if ($input->tag) {
            $models = $this->postRepository->findByTag($input->tag, $input->page, $input->perPage);
            $models = array_filter($models, fn($m) => $m->user_id === $userModel->id);
        } elseif ($input->search) {
            $models = $this->postRepository->searchByTitle($input->search, $input->page, $input->perPage);
            $models = array_filter($models, fn($m) => $m->user_id === $userModel->id);
        } else {
            $models = $this->postRepository->findByUserId($userId, $input->page, $input->perPage);
        }

        foreach ($models as $model) {
            $posts[] = PostMapper::fromModelToDTO($model, $model->comments->count());

            $tags = is_array($model->tags) ? $model->tags : json_decode($model->tags ?? '[]', true);
            $allTags = array_merge($allTags, $tags);
        }

        $allTags = array_unique($allTags);

        $total = $this->postRepository->countByUserId($userId);
        $lastPage = (int) ceil($total / $input->perPage);

        return new ListPostsOutputDTO(
            posts: $posts,
            currentPage: $input->page,
            perPage: $input->perPage,
            total: $total,
            lastPage: $lastPage,
            allTags: $allTags,
        );
    }
}
