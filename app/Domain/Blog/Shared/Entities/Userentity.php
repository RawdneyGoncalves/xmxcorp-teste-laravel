<?php

namespace App\Domain\Blog\Shared\Entities;

use App\Domain\Blog\Shared\ValueObjects\UserId;
use App\Domain\Blog\Shared\ValueObjects\Email;
use DateTime;

class UserEntity extends BaseEntity
{
    private UserId $userId;
    private string $firstName;
    private string $lastName;
    private Email $email;
    private ?string $phone;
    private ?string $image;
    private ?DateTime $birthDate;
    private ?array $address;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(
        UserId $userId,
        string $firstName,
        string $lastName,
        Email $email,
        ?string $phone = null,
        ?string $image = null,
        ?DateTime $birthDate = null,
        ?array $address = null,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null
    ) {
        parent::__construct($userId->getValue());

        $this->validateName($firstName);
        $this->validateName($lastName);

        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->image = $image;
        $this->birthDate = $birthDate;
        $this->address = $address;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getBirthDate(): ?DateTime
    {
        return $this->birthDate;
    }

    public function getAddress(): ?array
    {
        return $this->address;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    private function validateName(string $name): void
    {
        if (empty(trim($name)) || strlen($name) > 255) {
            throw new \InvalidArgumentException("Nome deve ter entre 1 e 255 caracteres");
        }
    }
}
