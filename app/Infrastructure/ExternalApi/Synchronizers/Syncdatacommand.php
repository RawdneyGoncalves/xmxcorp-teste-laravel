<?php

namespace App\Console\Commands;

use App\Infrastructure\ExternalApi\DummyJsonClient;
use App\Infrastructure\ExternalApi\Synchronizers\UserSynchronizer;
use App\Infrastructure\ExternalApi\Synchronizers\PostSynchronizer;
use App\Infrastructure\ExternalApi\Synchronizers\CommentSynchronizer;
use Illuminate\Console\Command;

class SyncDataCommand extends Command
{
    protected $signature = 'sync:data {--users} {--posts} {--comments} {--all}';
    protected $description = 'Sincroniza dados da DummyJSON API';

    public function handle(): int
    {
        $client = new DummyJsonClient();

        $all = $this->option('all');
        $users = $this->option('users') || $all;
        $posts = $this->option('posts') || $all;
        $comments = $this->option('comments') || $all;

        if (!$users && !$posts && !$comments) {
            $users = $posts = $comments = true;
        }

        if ($users) {
            $this->line('Sincronizando usuários...');
            try {
                $synchronizer = new UserSynchronizer($client);
                $count = $synchronizer->sync();
                $this->info("✓ {$count} usuários sincronizados");
            } catch (\Exception $e) {
                $this->error("Erro ao sincronizar usuários: " . $e->getMessage());
            }
        }

        if ($posts) {
            $this->line('Sincronizando posts...');
            try {
                $synchronizer = new PostSynchronizer($client);
                $count = $synchronizer->sync();
                $this->info("✓ {$count} posts sincronizados");
            } catch (\Exception $e) {
                $this->error("Erro ao sincronizar posts: " . $e->getMessage());
            }
        }

        if ($comments) {
            $this->line('Sincronizando comentários...');
            try {
                $synchronizer = new CommentSynchronizer($client);
                $count = $synchronizer->sync();
                $this->info("✓ {$count} comentários sincronizados");
            } catch (\Exception $e) {
                $this->error("Erro ao sincronizar comentários: " . $e->getMessage());
            }
        }

        $this->line('');
        $this->info('Sincronização concluída!');

        return Command::SUCCESS;
    }
}
