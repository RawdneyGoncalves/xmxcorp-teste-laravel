<?php

namespace App\Jobs;

use App\Infrastructure\ExternalApi\Services\SyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncDummyJsonDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 300;

    public function handle(): void
    {
        Log::info('Iniciando sincronização de dados da DummyJSON API');

        try {
            $syncService = new SyncService();
            $result = $syncService->syncAll(function ($message) {
                Log::info("Sync Progress: {$message}");
            });

            if (!empty($result['errors'])) {
                Log::warning('Erros durante sincronização', $result['errors']);
            } else {
                Log::info('Sincronização concluída com sucesso', [
                    'users' => $result['users'],
                    'posts' => $result['posts'],
                    'comments' => $result['comments'],
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Erro crítico durante sincronização', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }

    public function failed(\Exception $exception): void
    {
        Log::error('Job de sincronização falhou após múltiplas tentativas', [
            'message' => $exception->getMessage(),
        ]);
    }
}
