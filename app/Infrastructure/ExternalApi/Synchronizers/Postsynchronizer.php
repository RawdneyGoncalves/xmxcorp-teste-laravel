<?php

namespace App\Infrastructure\ExternalApi\Synchronizers;

use App\Infrastructure\ExternalApi\DummyJsonClient;
use App\Infrastructure\Persistence\Models\UserModel;
use App\Infrastructure\Persistence\Models\PostModel;

class PostSynchronizer
{
    public function __construct(private DummyJsonClient $client) {}

    public function sync(): int
    {
        $posts = $this->client->getPosts();
        $synchronized = 0;

        foreach ($posts as $postData) {
            $user = UserModel::where('external_id', $postData['userId'])->first();

            if (!$user) {
                continue;
            }

            PostModel::updateOrCreate(
                ['external_id' => $postData['id']],
                [
                    'user_id' => $user->id,
                    'title' => $postData['title'],
                    'body' => $postData['body'],
                    'tags' => json_encode($postData['tags'] ?? []),
                    'likes' => $postData['reactions']['likes'] ?? 0,
                    'dislikes' => $postData['reactions']['dislikes'] ?? 0,
                    'views' => $postData['views'] ?? 0,
                ]
            );

            $synchronized++;
        }

        return $synchronized;
    }
}
