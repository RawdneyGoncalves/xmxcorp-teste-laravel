<?php

namespace App\Domain\Blog\Shared\Entities;

use App\Domain\Blog\ValueObjects\PostId;
use App\Domain\Blog\ValueObjects\UserId;
use App\Domain\Blog\ValueObjects\Tag;
use DateTime;

class PostEntity extends BaseEntity
{
    private PostId $postId;
    private UserId $userId;
    private string $title;
    private string $body;
    private array $tags;
    private int $likes;
    private int $dislikes;
    private int $views;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(
        PostId $postId,
        UserId $userId,
        string $title,
        string $body,
        array $tags = [],
        int $likes = 0,
        int $dislikes = 0,
        int $views = 0,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    ) {
        parent::__construct($postId->getValue());

        $this->validateTitle($title);
        $this->validateBody($body);

        $this->postId = $postId;
        $this->userId = $userId;
        $this->title = $title;
        $this->body = $body;
        $this->tags = $this->validateAndCreateTags($tags);
        $this->likes = max(0, $likes);
        $this->dislikes = max(0, $dislikes);
        $this->views = max(0, $views);
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
    }

    public function getPostId(): PostId
    {
        return $this->postId;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function getDislikes(): int
    {
        return $this->dislikes;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function like(): void
    {
        $this->likes++;
    }

    public function dislike(): void
    {
        $this->dislikes++;
    }

    public function view(): void
    {
        $this->views++;
    }

    public function addTag(Tag $tag): void
    {
        $tagValue = $tag->getValue();
        if (!in_array($tagValue, $this->tags, true)) {
            $this->tags[] = $tagValue;
        }
    }

    public function removeTag(Tag $tag): void
    {
        $this->tags = array_filter(
            $this->tags,
            fn(string $t) => !$tag->equals(new Tag($t))
        );
    }

    private function validateTitle(string $title): void
    {
        if (empty(trim($title)) || strlen($title) > 255) {
            throw new \InvalidArgumentException("Titulo deve ter entre 1 e 255 caracteres");
        }
    }

    private function validateBody(string $body): void
    {
        if (empty(trim($body))) {
            throw new \InvalidArgumentException("Corpo do post nao pode ser vazio");
        }
    }

    private function validateAndCreateTags(array $tags): array
    {
        return array_map(fn(string $tag) => (new Tag($tag))->getValue(), $tags);
    }
}
