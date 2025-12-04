<?php

namespace App\Domain\Blog\UseCases;

use App\Domain\Blog\DTO\ListPostsInputDTO;
use App\Domain\Blog\DTO\ListPostsOutputDTO;
use App\Domain\Blog\Mappers\PostMapper;
use App\Domain\Blog\Interfaces\PostRepositoryInterface;

class ListPostsUseCase
{
    public function __construct(private PostRepositoryInterface $postRepository) {}

    public function execute(ListPostsInputDTO $input): ListPostsOutputDTO
    {
        $posts = [];
        $allTags = [];

        if ($input->tag) {
            $models = $this->postRepository->findByTag($input->tag, $input->page, $input->perPage);
        } elseif ($input->search) {
            $models = $this->postRepository->searchByTitle($input->search, $input->page, $input->perPage);
        } elseif ($input->minLikes !== null) {
            $models = $this->postRepository->findByMinLikes($input->minLikes, $input->page, $input->perPage);
        } elseif ($input->dateFrom) {
            $models = $this->postRepository->findByDateRange(
                $input->dateFrom,
                null,
                $input->page,
                $input->perPage
            );
        } else {
            $models = $this->postRepository->findAll($input->page, $input->perPage);
        }

        foreach ($models as $model) {
            $posts[] = PostMapper::fromModelToDTO($model, $model->comments->count());

            $tags = is_array($model->tags) ? $model->tags : json_decode($model->tags ?? '[]', true);
            $allTags = array_merge($allTags, $tags);
        }

        $allTags = array_unique($allTags);

        $total = $this->postRepository->count();
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
