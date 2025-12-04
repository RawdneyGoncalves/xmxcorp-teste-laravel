<?php

namespace App\Domain\Blog\UseCases;

use App\Domain\Blog\Interfaces\PostRepositoryInterface;
use App\Domain\Blog\Services\PostDomainService;
use App\Application\Shared\Exceptions\EntityNotFoundException;

class DislikePostUseCase
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
            $postId = $post->getPostId();
            $this->postDomainService->dislikePost($postId);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
