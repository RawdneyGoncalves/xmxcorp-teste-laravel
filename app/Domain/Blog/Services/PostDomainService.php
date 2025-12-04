<?php

namespace App\Domain\Blog\Services;

use App\Domain\Blog\Entities\PostEntity;
use App\Domain\Blog\Interfaces\PostRepositoryInterface;
use App\Domain\Blog\ValueObjects\PostId;

class PostDomainService
{
    public function __construct(private PostRepositoryInterface $postRepository) {}

    public function likePost(PostId $postId): void
    {
        $post = $this->postRepository->findById($postId);

        if (!$post) {
            throw new \DomainException("Post nao encontrado");
        }

        $post->like();
        $this->postRepository->save($post);
    }

    public function dislikePost(PostId $postId): void
    {
        $post = $this->postRepository->findById($postId);

        if (!$post) {
            throw new \DomainException("Post nao encontrado");
        }

        $post->dislike();
        $this->postRepository->save($post);
    }

    public function viewPost(PostId $postId): void
    {
        $post = $this->postRepository->findById($postId);

        if (!$post) {
            throw new \DomainException("Post nao encontrado");
        }

        $post->view();
        $this->postRepository->save($post);
    }

    public function calculatePopularity(PostEntity $post): float
    {
        $likes = $post->getLikes();
        $dislikes = $post->getDislikes();
        $views = $post->getViews();

        $totalReactions = $likes + $dislikes;

        if ($totalReactions === 0) {
            return 0.0;
        }

        $likeRate = $likes / $totalReactions;
        $engagementScore = ($likes * 2 - $dislikes) / max(1, $views);

        return ($likeRate * 0.7) + ($engagementScore * 0.3);
    }
}
