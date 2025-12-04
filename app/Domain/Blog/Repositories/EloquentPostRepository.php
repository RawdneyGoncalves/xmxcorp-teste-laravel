<?php

namespace App\Domain\Blog\Repositories;

use App\Domain\Blog\Interfaces\PostRepositoryInterface;
use App\Domain\Blog\Shared\Entities\PostEntity;
use App\Domain\Blog\ValueObjects\PostId;
use App\Domain\Blog\ValueObjects\UserId;
use App\Infrastructure\Persistence\Models\PostModel;
use DateTime;

class EloquentPostRepository implements PostRepositoryInterface
{
    public function __construct(
        private PostModel $model,
    ) {}

    public function findById(PostId $postId): ?PostEntity
    {
        $model = $this->model->where('external_id', $postId->getValue())->first();

        return $model ? $this->mapToEntity($model) : null;
    }

    public function findByExternalId(int $externalId): ?PostEntity
    {
        $model = $this->model->where('external_id', $externalId)->first();

        return $model ? $this->mapToEntity($model) : null;
    }

    public function findByUserId(UserId $userId, int $page = 1, int $perPage = 30): array
    {
        $query = $this->model
            ->where('user_id', $userId->getValue())
            ->orderBy('created_at', 'desc');

        $total = $query->count();
        $offset = ($page - 1) * $perPage;

        $posts = $query
            ->offset($offset)
            ->limit($perPage)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();

        return [
            'data' => $posts,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function findAll(int $page = 1, int $perPage = 30): array
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $total = $query->count();
        $offset = ($page - 1) * $perPage;

        $posts = $query
            ->offset($offset)
            ->limit($perPage)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();

        return [
            'data' => $posts,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function findByTag(string $tag, int $page = 1, int $perPage = 30): array
    {
        $query = $this->model
            ->whereJsonContains('tags', $tag)
            ->orderBy('created_at', 'desc');

        $total = $query->count();
        $offset = ($page - 1) * $perPage;

        $posts = $query
            ->offset($offset)
            ->limit($perPage)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();

        return [
            'data' => $posts,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function searchByTitle(string $title, int $page = 1, int $perPage = 30): array
    {
        $query = $this->model
            ->where('title', 'like', "%{$title}%")
            ->orderBy('created_at', 'desc');

        $total = $query->count();
        $offset = ($page - 1) * $perPage;

        $posts = $query
            ->offset($offset)
            ->limit($perPage)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();

        return [
            'data' => $posts,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function findByMinLikes(int $minLikes, int $page = 1, int $perPage = 30): array
    {
        $query = $this->model
            ->where('likes', '>=', $minLikes)
            ->orderBy('likes', 'desc');

        $total = $query->count();
        $offset = ($page - 1) * $perPage;

        $posts = $query
            ->offset($offset)
            ->limit($perPage)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();

        return [
            'data' => $posts,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function findByDateRange(DateTime $from, DateTime $to = null, int $page = 1, int $perPage = 30): array
    {
        $query = $this->model->where('created_at', '>=', $from);

        if ($to) {
            $query->where('created_at', '<=', $to);
        }

        $query->orderBy('created_at', 'desc');

        $total = $query->count();
        $offset = ($page - 1) * $perPage;

        $posts = $query
            ->offset($offset)
            ->limit($perPage)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();

        return [
            'data' => $posts,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function save(PostEntity $post): void
    {
        $this->model->updateOrCreate(
            ['external_id' => $post->getPostId()->getValue()],
            [
                'user_id' => $post->getUserId()->getValue(),
                'title' => $post->getTitle(),
                'body' => $post->getBody(),
                'tags' => $post->getTags(),
                'likes' => $post->getLikes(),
                'dislikes' => $post->getDislikes(),
                'views' => $post->getViews(),
            ]
        );
    }

    public function delete(PostId $postId): void
    {
        $this->model
            ->where('external_id', $postId->getValue())
            ->delete();
    }

    public function count(): int
    {
        return $this->model->count();
    }

    public function countByUserId(UserId $userId): int
    {
        return $this->model
            ->where('user_id', $userId->getValue())
            ->count();
    }

    private function mapToEntity(PostModel $model): PostEntity
    {
        return new PostEntity(
            postId: new PostId($model->external_id),
            userId: new UserId($model->user_id),
            title: $model->title,
            body: $model->body,
            tags: $model->tags ?? [],
            likes: $model->likes ?? 0,
            dislikes: $model->dislikes ?? 0,
            views: $model->views ?? 0,
        );
    }
}
