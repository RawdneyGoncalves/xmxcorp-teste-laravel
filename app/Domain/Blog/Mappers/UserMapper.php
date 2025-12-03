<?php

namespace App\Application\Blog\Mappers;

use App\Application\Blog\DTO\UserOutputDTO;
use App\Domain\Blog\Entities\UserEntity;
use App\Infrastructure\Persistence\Models\UserModel;

class UserMapper
{
    public static function fromEntityToDTO(UserEntity $entity): UserOutputDTO
    {
        return new UserOutputDTO(
            id: $entity->getUserId()->getValue(),
            externalId: $entity->getUserId()->getValue(),
            firstName: $entity->getFirstName(),
            lastName: $entity->getLastName(),
            email: $entity->getEmail()->getValue(),
            phone: $entity->getPhone(),
            image: $entity->getImage(),
            birthDate: $entity->getBirthDate() ? $entity->getBirthDate()->format('Y-m-d') : null,
            address: $entity->getAddress()
        );
    }

    public static function fromModelToDTO(UserModel $model): UserOutputDTO
    {
        return new UserOutputDTO(
            id: $model->id,
            externalId: $model->external_id,
            firstName: $model->first_name,
            lastName: $model->last_name,
            email: $model->email,
            phone: $model->phone,
            image: $model->image,
            birthDate: $model->birth_date ? $model->birth_date->format('Y-m-d') : null,
            address: is_array($model->address) ? $model->address : json_decode($model->address ?? '{}', true)
        );
    }

    public static function fromArrayToDTO(array $data): UserOutputDTO
    {
        return new UserOutputDTO(
            id: $data['id'] ?? null,
            externalId: $data['external_id'] ?? $data['id'] ?? null,
            firstName: $data['first_name'] ?? $data['firstName'] ?? '',
            lastName: $data['last_name'] ?? $data['lastName'] ?? '',
            email: $data['email'] ?? '',
            phone: $data['phone'] ?? null,
            image: $data['image'] ?? null,
            birthDate: $data['birth_date'] ?? $data['birthDate'] ?? null,
            address: is_array($data['address'] ?? null) ? $data['address'] : []
        );
    }
}
