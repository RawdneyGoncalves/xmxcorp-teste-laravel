<?php

namespace App\Domain\Blog\Shared\ValueObjects;

final class Tag
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty(trim($value))) {
            throw new \InvalidArgumentException("Tag não pode ser vazia");
        }

        $this->value = trim($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(Tag $other): bool
    {
        return strtolower($this->value) === strtolower($other->getValue());
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
