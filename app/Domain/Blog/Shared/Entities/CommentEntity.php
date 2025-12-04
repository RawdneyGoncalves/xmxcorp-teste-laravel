<?php

namespace App\Domain\Blog\Shared\Entities;

use App\Domain\Blog\ValueObjects\PostId;
use App\Domain\Blog\ValueObjects\UserId;
use DateTime;

class CommentEntity extends BaseEntity
{
    private int $commentId;
    private PostId $postId;
    private UserId $userId;
    private string $body;
    private int $likes;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(
        int $commentId,
        PostId $postId,
        UserId $userId,
        string $body,
        int $likes = 0,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    ) {
        parent::__construct($commentId);

        $this->validateBody($body);

        $this->commentId = $commentId;
        $this->postId = $postId;
        $this->userId = $userId;
        $this->body = $body;
        $this->likes = max(0, $likes);
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function getPostId(): PostId
    {
        return $this->postId;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getLikes(): int
    {
        return $this->likes;
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

    private function validateBody(string $body): void
    {
        if (empty(trim($body))) {
            throw new \InvalidArgumentException("Comentário não pode ser vazio");
        }
    }
}
