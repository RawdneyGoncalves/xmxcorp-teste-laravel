<?php

namespace App\Domain\Blog\Mappers;

use App\Domain\Blog\DTO\PostOutputDTO;
use App\Domain\Blog\DTO\UserOutputDTO;
use App\Domain\Blog\Entities\PostEntity;
use App\Domain\Blog\Entities\UserEntity;
use App\Infrastructure\Persistence\Models\PostModel;

class PostMapper
{
    public static function fromEntityToDTO(
        PostEntity $entity,
        UserEntity $author,
        int $commentCount = 0
    ): PostOutputDTO {
        return new PostOutputDTO(
            id: $entity->getPostId()->getValue(),
            externalId: $entity->getPostId()->getValue(),
            title: $entity->getTitle(),
            body: $entity->getBody(),
            tags: $entity->getTags(),
            likes: $entity->getLikes(),
            dislikes: $entity->getDislikes(),
            views: $entity->getViews(),
            commentCount: $commentCount,
            author: UserMapper::fromEntityToDTO($author),
            createdAt: $entity->getCreatedAt()->format('Y-m-d H:i:s'),
        );
    }

    public static function fromModelToDTO(
        PostModel $model,
        int $commentCount = 0
    ): PostOutputDTO {
        return new PostOutputDTO(
            id: $model->id,
            externalId: $model->external_id,
            title: $model->title,
            body: $model->body,
            tags: is_array($model->tags) ? $model->tags : json_decode($model->tags ?? '[]', true),
            likes: $model->likes,
            dislikes: $model->dislikes,
            views: $model->views,
            commentCount: $commentCount,
            author: UserMapper::fromModelToDTO($model->user),
            createdAt: $model->created_at->format('Y-m-d H:i:s'),
        );
    }
}
