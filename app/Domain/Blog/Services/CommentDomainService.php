<?php

namespace App\Domain\Blog\Services;

use App\Domain\Blog\Shared\Entities\CommentEntity;
use App\Domain\Blog\Interfaces\CommentRepositoryInterface;
use App\Domain\Blog\ValueObjects\PostId;

class CommentDomainService
{
    public function __construct(private CommentRepositoryInterface $commentRepository) {}

    public function likeComment(int $commentId): void
    {
        $comment = $this->commentRepository->findById($commentId);

        if (!$comment) {
            throw new \DomainException("Comentario nao encontrado");
        }

        $comment->like();
        $this->commentRepository->save($comment);
    }

    public function deleteComment(int $commentId): void
    {
        $comment = $this->commentRepository->findById($commentId);

        if (!$comment) {
            throw new \DomainException("Comentario nao encontrado");
        }

        $this->commentRepository->delete($commentId);
    }

    public function calculateRelevance(CommentEntity $comment): float
    {
        $likes = $comment->getLikes();
        $now = new \DateTime();
        $daysSinceCreation = (int) $comment->getCreatedAt()->diff($now)->format('%d');

        if ($daysSinceCreation === 0) {
            $daysSinceCreation = 1;
        }

        $likeScore = $likes / max(1, $daysSinceCreation);

        return min($likeScore * 10, 100.0);
    }

    public function getCommentsByPost(PostId $postId, int $page = 1, int $perPage = 30): array
    {
        return $this->commentRepository->findByPostId($postId, $page, $perPage);
    }

    public function countCommentsByPost(PostId $postId): int
    {
        return $this->commentRepository->countByPostId($postId);
    }
}
