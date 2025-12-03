<?php

namespace App\Application\Blog\UseCases;

use App\Domain\Blog\Repositories\PostRepositoryInterface;
use App\Domain\Blog\Services\PostDomainService;
use App\Application\Shared\Exceptions\EntityNotFoundException;

class LikePostUseCase
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private PostDomainService $postDomainService,
    ) {}

    public function execute(int $externalPostId): bool
    {
        $post = $this->postRepository->findByExternalId($externalPostId);

        if (!$post) {
            throw new EntityNotFoundException("Post nao encontrado");
        }

        try {
            $this->postDomainService->likePost($post->getPostId());
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
