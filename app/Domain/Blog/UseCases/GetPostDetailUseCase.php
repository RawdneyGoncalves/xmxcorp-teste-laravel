<?php

namespace App\Domain\Blog\UseCases;

use App\Domain\Blog\DTO\PostDetailOutputDTO;
use App\Domain\Blog\Mappers\CommentMapper;
use App\Domain\Blog\Mappers\PostMapper;
use App\Domain\Blog\Interfaces\PostRepositoryInterface;
use App\Domain\Blog\Services\PostDomainService;
use App\Application\Shared\Exceptions\EntityNotFoundException;
use App\Infrastructure\Persistence\Models\PostModel;

class GetPostDetailUseCase
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private PostDomainService $postDomainService,
    ) {}

    public function execute(int $externalPostId): PostDetailOutputDTO
    {
        $post = $this->postRepository->findByExternalId($externalPostId);

        if (!$post) {
            throw new EntityNotFoundException("Post nao encontrado");
        }

        $this->postDomainService->viewPost($post->getPostId());

        $postModel = PostModel::query()->where('external_id', $externalPostId)->first();

        $postMapper = PostMapper::fromModelToDTO($postModel, $postModel->comments->count());

        $comments = [];
        foreach ($postModel->comments as $commentModel) {
            $comments[] = CommentMapper::fromModelToDTO($commentModel);
        }

        return new PostDetailOutputDTO(
            post: $postMapper,
            comments: $comments,
        );
    }
}
