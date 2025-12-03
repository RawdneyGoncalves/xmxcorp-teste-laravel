<?php

namespace App\Infrastructure\ExternalApi\Synchronizers;

use App\Infrastructure\ExternalApi\DummyJsonClient;
use App\Infrastructure\Persistence\Models\UserModel;

class UserSynchronizer
{
    public function __construct(private DummyJsonClient $client) {}

    public function sync(): int
    {
        $users = $this->client->getUsers();
        $synchronized = 0;

        foreach ($users as $userData) {
            UserModel::updateOrCreate(
                ['external_id' => $userData['id']],
                [
                    'first_name' => $userData['firstName'],
                    'last_name' => $userData['lastName'],
                    'email' => $userData['email'],
                    'phone' => $userData['phone'] ?? null,
                    'image' => $userData['image'] ?? null,
                    'birth_date' => $userData['birthDate'] ?? null,
                    'address' => isset($userData['address']) ? json_encode($userData['address']) : null,
                ]
            );

            $synchronized++;
        }

        return $synchronized;
    }
}
