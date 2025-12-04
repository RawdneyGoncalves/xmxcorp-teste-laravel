<?php

namespace App\Providers;

use App\Infrastructure\ExternalApi\Services\SyncService;
use App\Jobs\SyncDummyJsonDataJob;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class SyncServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Sincronizar automaticamente quando a aplicação inicia em requisições web
        if ($this->app->runningInConsole()) {
            return;
        }

        try {
            $syncService = new SyncService();

            if ($syncService->shouldSync()) {
                // Sincronizar em background sem bloquear a requisição
                dispatch(new SyncDummyJsonDataJob());
            }
        } catch (\Exception $e) {
            Log::warning("Erro ao verificar sincronização: {$e->getMessage()}");
        }
    }

    public function register(): void
    {
        $this->app->singleton(SyncService::class, function ($app) {
            return new SyncService();
        });
    }
}
