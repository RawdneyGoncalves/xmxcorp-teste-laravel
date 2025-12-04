<?php

namespace App\Domain\Blog\Shared\Entities;

abstract class BaseEntity
{
    protected mixed $id;

    public function __construct(mixed $id)
    {
        $this->id = $id;
    }

    public function getId(): mixed
    {
        return $this->id;
    }

    public function equals(BaseEntity $other): bool
    {
        return $this->id === $other->getId();
    }
}
