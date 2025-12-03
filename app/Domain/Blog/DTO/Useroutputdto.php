<?php

namespace App\Application\Blog\DTO;

final class UserOutputDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $externalId,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly ?string $phone,
        public readonly ?string $image,
        public readonly ?string $birthDate,
        public readonly ?array $address,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'externalId' => $this->externalId,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $this->image,
            'birthDate' => $this->birthDate,
            'address' => $this->address,
        ];
    }

    public function getFullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
