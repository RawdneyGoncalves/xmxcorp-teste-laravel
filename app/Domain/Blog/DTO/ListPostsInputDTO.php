<?php

namespace App\Application\Blog\DTO;

final class ListPostsInputDTO
{
    public function __construct(
        public readonly int $page = 1,
        public readonly int $perPage = 30,
        public readonly ?string $tag = null,
        public readonly ?string $search = null,
        public readonly ?int $minLikes = null,
        public readonly ?\DateTime $dateFrom = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            page: (int) ($data['page'] ?? 1),
            perPage: (int) ($data['perPage'] ?? 30),
            tag: $data['tag'] ?? null,
            search: $data['search'] ?? null,
            minLikes: isset($data['min_likes']) ? (int) $data['min_likes'] : null,
            dateFrom: isset($data['date_from']) ? new \DateTime($data['date_from']) : null,
        );
    }
}
