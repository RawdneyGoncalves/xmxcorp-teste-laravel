<?php

namespace App\Presentation\Http\Controllers\Blog;

use App\Infrastructure\ExternalApi\DummyJsonClient;
use App\Infrastructure\Persistence\Models\UserModel;
use App\Infrastructure\Persistence\Models\PostModel;
use App\Infrastructure\Persistence\Models\CommentModel;
use App\Presentation\Http\Controllers\BaseController;

class StatusController extends BaseController
{
    public function check()
    {
        $status = [
            'api' => $this->checkApi(),
            'database' => [
                'users' => UserModel::count(),
                'posts' => PostModel::count(),
                'comments' => CommentModel::count(),
            ],
            'samples' => $this->getSamples(),
        ];

        return view('status', $status);
    }

    private function checkApi(): array
    {
        try {
            $client = new DummyJsonClient();
            $users = $client->getUsers(1);
            $posts = $client->getPosts(1);
            $comments = $client->getComments(1);

            return [
                'status' => 'online',
                'users_api' => !empty($users),
                'posts_api' => !empty($posts),
                'comments_api' => !empty($comments),
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }

    private function getSamples(): array
    {
        return [
            'user' => UserModel::latest()->first()?->only(['first_name', 'last_name', 'email']),
            'post' => PostModel::latest()->first()?->only(['title', 'likes', 'views']),
            'comment' => CommentModel::latest()->first()?->only(['body', 'likes']),
        ];
    }
}
