<?php

namespace App\Infrastructure\ExternalApi\Services;

use App\Infrastructure\ExternalApi\DummyJsonClient;
use App\Infrastructure\ExternalApi\Synchronizers\UserSynchronizer;
use App\Infrastructure\ExternalApi\Synchronizers\PostSynchronizer;
use App\Infrastructure\ExternalApi\Synchronizers\CommentSynchronizer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SyncService
{
    private DummyJsonClient $client;
    private UserSynchronizer $userSync;
    private PostSynchronizer $postSync;
    private CommentSynchronizer $commentSync;

    public function __construct()
    {
        $this->client = new DummyJsonClient();
        $this->userSync = new UserSynchronizer($this->client);
        $this->postSync = new PostSynchronizer($this->client);
        $this->commentSync = new CommentSynchronizer($this->client);
    }

    public function syncAll(callable $progress = null): array
    {
        $results = [
            'users' => 0,
            'posts' => 0,
            'comments' => 0,
            'errors' => [],
            'timestamp' => now(),
        ];

        try {
            // Sincronizar usuários
            if ($progress) {
                $progress('Sincronizando usuários...');
            }
            $results['users'] = $this->userSync->sync();
            Log::info("Sincronizados {$results['users']} usuários");

        } catch (\Exception $e) {
            $results['errors'][] = "Usuários: {$e->getMessage()}";
            Log::error("Erro ao sincronizar usuários: {$e->getMessage()}");
        }

        try {
            // Sincronizar posts
            if ($progress) {
                $progress('Sincronizando posts...');
            }
            $results['posts'] = $this->postSync->sync();
            Log::info("Sincronizados {$results['posts']} posts");

        } catch (\Exception $e) {
            $results['errors'][] = "Posts: {$e->getMessage()}";
            Log::error("Erro ao sincronizar posts: {$e->getMessage()}");
        }

        try {
            // Sincronizar comentários
            if ($progress) {
                $progress('Sincronizando comentários...');
            }
            $results['comments'] = $this->commentSync->sync();
            Log::info("Sincronizados {$results['comments']} comentários");

        } catch (\Exception $e) {
            $results['errors'][] = "Comentários: {$e->getMessage()}";
            Log::error("Erro ao sincronizar comentários: {$e->getMessage()}");
        }

        // Cachear resultado da sincronização
        Cache::put('sync_result', $results, now()->addHour());
        Cache::put('last_sync', now(), now()->addDay());

        return $results;
    }

    public function getLastSyncResult(): ?array
    {
        return Cache::get('sync_result');
    }

    public function getLastSyncTime(): ?\DateTime
    {
        return Cache::get('last_sync');
    }

    public function shouldSync(): bool
    {
        $lastSync = $this->getLastSyncTime();

        if (!$lastSync) {
            return true;
        }

        // Sincronizar a cada 6 horas em produção, a cada hora em desenvolvimento
        $interval = app()->isProduction() ? 6 : 1;

        return now()->diffInHours($lastSync) >= $interval;
    }

    public function clearCache(): void
    {
        $this->client->clearCache();
        Cache::forget('sync_result');
        Cache::forget('last_sync');
    }
}
