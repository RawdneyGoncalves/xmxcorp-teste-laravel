<?php

namespace App\Domain\Blog\Repositories;

use App\Domain\Blog\Interfaces\UserRepositoryInterface;
use App\Domain\Blog\Entities\UserEntity;
use App\Domain\Blog\ValueObjects\UserId;
use App\Domain\Shared\ValueObjects\Email;
use App\Infrastructure\Persistence\Models\UserModel;


class EloquentUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private UserModel $model,
    ) {}

    public function findById(UserId $userId): ?UserEntity
    {
        $model = $this->model->where('external_id', $userId->getValue())->first();

        return $model ? $this->mapToEntity($model) : null;
    }

    public function findByExternalId(int $externalId): ?UserEntity
    {
        $model = $this->model->where('external_id', $externalId)->first();

        return $model ? $this->mapToEntity($model) : null;
    }

    public function findAll(int $page = 1, int $perPage = 30): array
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $total = $query->count();
        $offset = ($page - 1) * $perPage;

        $users = $query
            ->offset($offset)
            ->limit($perPage)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();

        return [
            'data' => $users,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function findByEmail(string $email): ?UserEntity
    {
        $model = $this->model->where('email', $email)->first();

        return $model ? $this->mapToEntity($model) : null;
    }

    public function save(UserEntity $user): void
    {
        $this->model->updateOrCreate(
            ['external_id' => $user->getUserId()->getValue()],
            [
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail()->getValue(),
                'phone' => $user->getPhone(),
                'birth_date' => $user->getBirthDate(),
                'image' => $user->getImage(),
                'address' => $user->getAddress(),
            ]
        );
    }

    public function delete(UserId $userId): void
    {
        $this->model
            ->where('external_id', $userId->getValue())
            ->delete();
    }

    public function count(): int
    {
        return $this->model->count();
    }

    private function mapToEntity(UserModel $model): UserEntity
    {
        return new UserEntity(
            userId: new UserId($model->external_id),
            firstName: $model->first_name,
            lastName: $model->last_name,
            email: new Email($model->email),
            phone: $model->phone,
            birthDate: $model->birth_date,
            image: $model->image,
            address: $model->address ?? [],
        );
    }
}
