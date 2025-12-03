<?php

namespace App\Application\Blog\Mappers;

use App\Application\Blog\DTO\CommentOutputDTO;
use App\Domain\Blog\Entities\CommentEntity;
use App\Domain\Blog\Entities\UserEntity;
use App\Infrastructure\Persistence\Models\CommentModel;

class CommentMapper
{
    public static function fromEntityToDTO(
        CommentEntity $entity,
        UserEntity $author
    ): CommentOutputDTO {
        return new CommentOutputDTO(
            id: $entity->getCommentId(),
            externalId: $entity->getCommentId(),
            body: $entity->getBody(),
            likes: $entity->getLikes(),
            author: UserMapper::fromEntityToDTO($author),
            createdAt: $entity->getCreatedAt()->format('Y-m-d H:i:s'),
        );
    }

    public static function fromModelToDTO(CommentModel $model): CommentOutputDTO
    {
        return new CommentOutputDTO(
            id: $model->id,
            externalId: $model->external_id,
            body: $model->body,
            likes: $model->likes,
            author: UserMapper::fromModelToDTO($model->user),
            createdAt: $model->created_at->format('Y-m-d H:i:s'),
        );
    }
}
