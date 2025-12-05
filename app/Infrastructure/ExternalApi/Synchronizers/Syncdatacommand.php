<?php

namespace App\Console\Commands;

use App\Infrastructure\ExternalApi\DummyJsonClient;
use App\Infrastructure\ExternalApi\Services\SyncService;
use App\Infrastructure\ExternalApi\Synchronizers\UserSynchronizer;
use App\Infrastructure\ExternalApi\Synchronizers\PostSynchronizer;
use App\Infrastructure\ExternalApi\Synchronizers\CommentSynchronizer;
use Illuminate\Console\Command;

class SyncDataCommand extends Command
{
    protected $signature = 'sync:data {--force} {--clear}';
    protected $description = 'Sincroniza dados da DummyJSON API';

    public function handle(): int
    {
        $client = new DummyJsonClient();

        if ($this->option('clear')) {
            $client->clearCache();
            $this->info('✓ Cache limpo');
        }

        $userSync = new UserSynchronizer($client);
        $postSync = new PostSynchronizer($client);
        $commentSync = new CommentSynchronizer($client);

        $syncService = new SyncService($client, $userSync, $postSync, $commentSync);

        if (!$this->option('force') && !$syncService->shouldSync()) {
            $lastSync = $syncService->getLastSyncTime();
            $this->info("Última sincronização: {$lastSync}");
            $this->info("Sincronização não necessária (próxima em 6h)");
            return Command::SUCCESS;
        }

        try {
            $this->line('');
            $results = $syncService->syncAll(function ($message) {
                $this->line("  $message");
            });

            $this->line('');
            $this->info("✓ {$results['users']} usuários sincronizados");
            $this->info("✓ {$results['posts']} posts sincronizados");
            $this->info("✓ {$results['comments']} comentários sincronizados");
            $this->line('');
            $this->info('Sincronização concluída com sucesso!');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Erro na sincronização: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
