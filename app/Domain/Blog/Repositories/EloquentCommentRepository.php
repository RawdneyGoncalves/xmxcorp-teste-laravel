<?php

namespace App\Domain\Blog\Repositories;

use App\Domain\Blog\Interfaces\CommentRepositoryInterface;
use App\Domain\Blog\Shared\Entities\CommentEntity;
use App\Domain\Blog\Shared\ValueObjects\PostId;
use App\Domain\Blog\Shared\ValueObjects\UserId;
use App\Infrastructure\Persistence\Models\CommentModel;

class EloquentCommentRepository implements CommentRepositoryInterface
{
    public function __construct(
        private CommentModel $model,
    ) {}

    public function findById(int $commentId): ?CommentEntity
    {
        $model = $this->model->find($commentId);

        return $model ? $this->mapToEntity($model) : null;
    }

    public function findByExternalId(int $externalId): ?CommentEntity
    {
        $model = $this->model->where('external_id', $externalId)->first();

        return $model ? $this->mapToEntity($model) : null;
    }

    public function findByPostId(PostId $postId, int $page = 1, int $perPage = 30): array
    {
        $query = $this->model
            ->where('post_id', $postId->getValue())
            ->orderBy('created_at', 'desc');

        $total = $query->count();
        $offset = ($page - 1) * $perPage;

        $comments = $query
            ->offset($offset)
            ->limit($perPage)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();

        return [
            'data' => $comments,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function findAll(int $page = 1, int $perPage = 30): array
    {
        $query = $this->model
            ->orderBy('created_at', 'desc');

        $total = $query->count();
        $offset = ($page - 1) * $perPage;

        $comments = $query
            ->offset($offset)
            ->limit($perPage)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();

        return [
            'data' => $comments,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function save(CommentEntity $comment): void
    {
        $this->model->updateOrCreate(
            ['id' => $comment->getCommentId()],
            [
                'post_id' => $comment->getPostId()->getValue(),
                'user_id' => $comment->getUserId()->getValue(),
                'body' => $comment->getBody(),
                'likes' => $comment->getLikes(),
            ]
        );
    }

    public function delete(int $commentId): void
    {
        $this->model->find($commentId)?->delete();
    }

    public function countByPostId(PostId $postId): int
    {
        return $this->model
            ->where('post_id', $postId->getValue())
            ->count();
    }

    private function mapToEntity(CommentModel $model): CommentEntity
    {
        return new CommentEntity(
            commentId: $model->id,
            postId: new PostId($model->post_id),
            userId: new UserId($model->user_id),
            body: $model->body,
            likes: $model->likes ?? 0,
            createdAt: $model->created_at,
            updatedAt: $model->updated_at,
        );
    }
}
