<?php

namespace App\Infrastructure\ExternalApi\Synchronizers;

use App\Infrastructure\ExternalApi\DummyJsonClient;
use App\Infrastructure\Persistence\Models\PostModel;
use App\Infrastructure\Persistence\Models\UserModel;
use App\Infrastructure\Persistence\Models\CommentModel;

class CommentSynchronizer
{
    public function __construct(private DummyJsonClient $client) {}

    public function sync(): int
    {
        $comments = $this->client->getComments();
        $synchronized = 0;

        foreach ($comments as $commentData) {
            $post = PostModel::where('external_id', $commentData['postId'])->first();
            $user = UserModel::where('external_id', $commentData['user']['id'])->first();

            if (!$post || !$user) {
                continue;
            }

            CommentModel::updateOrCreate(
                ['external_id' => $commentData['id']],
                [
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                    'body' => $commentData['body'],
                    'likes' => $commentData['likes'] ?? 0,
                ]
            );

            $synchronized++;
        }

        return $synchronized;
    }
}
