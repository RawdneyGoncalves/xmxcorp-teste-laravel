<?php

namespace App\Infrastructure\ExternalApi;

use Illuminate\Support\Facades\Http;

class DummyJsonClient
{
    private const BASE_URL = 'https://dummyjson.com';

    public function getUsers(int $limit = 300): array
    {
        $response = Http::get(self::BASE_URL . '/users', ['limit' => $limit]);

        if (!$response->successful()) {
            throw new \RuntimeException("Erro ao buscar usuários da API");
        }

        return $response->json()['users'] ?? [];
    }

    public function getPosts(int $limit = 300): array
    {
        $response = Http::get(self::BASE_URL . '/posts', ['limit' => $limit]);

        if (!$response->successful()) {
            throw new \RuntimeException("Erro ao buscar posts da API");
        }

        return $response->json()['posts'] ?? [];
    }

    public function getComments(int $limit = 500): array
    {
        $response = Http::get(self::BASE_URL . '/comments', ['limit' => $limit]);

        if (!$response->successful()) {
            throw new \RuntimeException("Erro ao buscar comentários da API");
        }

        return $response->json()['comments'] ?? [];
    }
}
