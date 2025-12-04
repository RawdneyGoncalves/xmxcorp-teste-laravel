<?php

namespace App\Infrastructure\ExternalApi;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DummyJsonClient
{
    private const BASE_URL = 'https://dummyjson.com';
    private const CACHE_TTL = 3600;

    public function getUsers(int $limit = 300): array
    {
        try {
            $cacheKey = "dummyjson_users_{$limit}";

            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }

            $response = Http::timeout(30)
                ->retry(3, 100)
                ->get(self::BASE_URL . '/users', ['limit' => $limit]);

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json()['users'] ?? [];
            Cache::put($cacheKey, $data, self::CACHE_TTL);

            return $data;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getPosts(int $limit = 300): array
    {
        try {
            $cacheKey = "dummyjson_posts_{$limit}";

            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }

            $response = Http::timeout(30)
                ->retry(3, 100)
                ->get(self::BASE_URL . '/posts', ['limit' => $limit]);

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json()['posts'] ?? [];
            Cache::put($cacheKey, $data, self::CACHE_TTL);

            return $data;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getComments(int $limit = 500): array
    {
        try {
            $cacheKey = "dummyjson_comments_{$limit}";

            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }

            $response = Http::timeout(30)
                ->retry(3, 100)
                ->get(self::BASE_URL . '/comments', ['limit' => $limit]);

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json()['comments'] ?? [];
            Cache::put($cacheKey, $data, self::CACHE_TTL);

            return $data;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function clearCache(): void
    {
        Cache::forget('dummyjson_users_300');
        Cache::forget('dummyjson_posts_300');
        Cache::forget('dummyjson_comments_500');
    }
}
