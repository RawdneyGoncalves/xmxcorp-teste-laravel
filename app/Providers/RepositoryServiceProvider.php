<?php

namespace App\Providers;

use App\Domain\Blog\Interfaces\CommentRepositoryInterface;
use App\Domain\Blog\Interfaces\PostRepositoryInterface;
use App\Domain\Blog\Interfaces\UserRepositoryInterface;
use App\Domain\Blog\Repositories\EloquentCommentRepository;
use App\Domain\Blog\Repositories\EloquentPostRepository;
use App\Domain\Blog\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerRepositories();
    }

    public function boot(): void
    {
    }

    private function registerRepositories(): void
    {
        $this->app->bind(
            PostRepositoryInterface::class,
            EloquentPostRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            EloquentCommentRepository::class
        );
    }
}
