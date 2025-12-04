<?php

namespace App\Domain\Blog\DTO;

class ListPostsInputDTO
{
    public int $page = 1;
    public int $perPage = 15;
    public ?string $tag = null;
    public ?string $search = null;
    public ?int $minLikes = null;
    public ?\DateTime $dateFrom = null;

    public static function fromArray(array $data): self
    {
        $dto = new self();
        $dto->page = (int) ($data['page'] ?? 1);
        $dto->perPage = (int) ($data['per_page'] ?? 15);
        $dto->tag = $data['tag'] ?? null;
        $dto->search = $data['search'] ?? null;
        $dto->minLikes = isset($data['min_likes']) ? (int) $data['min_likes'] : null;
        $dto->dateFrom = isset($data['date_from']) ? new \DateTime($data['date_from']) : null;

        return $dto;
    }
}
