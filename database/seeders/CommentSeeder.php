<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Models\CommentModel;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $comments = [
            ['post_id' => 1, 'user_id' => 2, 'body' => 'This is some awesome thinking!', 'likes' => 3],
            ['post_id' => 1, 'user_id' => 3, 'body' => 'Really insightful perspective. Thanks for sharing.', 'likes' => 7],
            ['post_id' => 1, 'user_id' => 4, 'body' => 'I completely agree with this sentiment. It\'s a valuable reminder.', 'likes' => 5],
            ['post_id' => 2, 'user_id' => 1, 'body' => 'Great use of the pangram example. Very clear explanation.', 'likes' => 8],
            ['post_id' => 2, 'user_id' => 5, 'body' => 'I never knew that about typography testing. Very interesting!', 'likes' => 12],
            ['post_id' => 3, 'user_id' => 6, 'body' => 'This is exactly what I needed to hear. Simplicity is indeed elegance.', 'likes' => 9],
            ['post_id' => 3, 'user_id' => 2, 'body' => 'Your writing demonstrates this principle perfectly.', 'likes' => 4],
            ['post_id' => 4, 'user_id' => 3, 'body' => 'Passion is everything. This resonates deeply with me.', 'likes' => 15],
            ['post_id' => 4, 'user_id' => 4, 'body' => 'How do you discover what you truly love to do?', 'likes' => 6],
            ['post_id' => 5, 'user_id' => 5, 'body' => 'Authenticity is becoming rare. Thanks for the reminder.', 'likes' => 11],
            ['post_id' => 5, 'user_id' => 6, 'body' => 'Being yourself requires courage. Well said.', 'likes' => 8],
            ['post_id' => 6, 'user_id' => 1, 'body' => 'Dreams do require action to become reality. Great point.', 'likes' => 14],
            ['post_id' => 6, 'user_id' => 2, 'body' => 'Visualization is powerful. I practice this daily.', 'likes' => 10],
            ['post_id' => 7, 'user_id' => 3, 'body' => 'This is powerful. Darkness teaches us to appreciate light.', 'likes' => 13],
            ['post_id' => 7, 'user_id' => 4, 'body' => 'Resilience is built through adversity. I agree completely.', 'likes' => 9],
            ['post_id' => 8, 'user_id' => 5, 'body' => 'Taking the first step is always the hardest. But it\'s essential.', 'likes' => 16],
            ['post_id' => 8, 'user_id' => 6, 'body' => 'Begin now, perfect later. I\'m going to live by this.', 'likes' => 7],
        ];

        foreach ($comments as $comment) {
            CommentModel::create($comment);
        }
    }
}
