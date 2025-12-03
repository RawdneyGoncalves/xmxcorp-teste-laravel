<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Models\PostModel;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'external_id' => 1,
                'user_id' => 1,
                'title' => 'His mother had always taught him',
                'body' => 'His mother had always taught him not to ever think of himself as better than others. He\'d tried to live by this motto. He never looked down on those who were less fortunate or who had less money than him. But the stupidity of the group of people he was talking to made him change his mind.',
                'tags' => json_encode(['history', 'american', 'crime']),
                'likes' => 192,
                'dislikes' => 25,
                'views' => 305,
            ],
            [
                'external_id' => 2,
                'user_id' => 2,
                'title' => 'The quick brown fox jumps over the lazy dog',
                'body' => 'The quick brown fox jumps over the lazy dog. This is a classic pangram that contains every letter of the English alphabet at least once. It\'s often used in typography and testing to demonstrate how fonts look with various characters.',
                'tags' => json_encode(['typography', 'design', 'testing']),
                'likes' => 156,
                'dislikes' => 12,
                'views' => 428,
            ],
            [
                'external_id' => 3,
                'user_id' => 3,
                'title' => 'The art of writing is discovering what to leave out',
                'body' => 'The art of writing is discovering what to leave out. Writing is about clarity and precision. When you can remove words without changing meaning, you should. Simplicity is elegance. Every word must earn its place on the page.',
                'tags' => json_encode(['writing', 'literature', 'craft']),
                'likes' => 287,
                'dislikes' => 8,
                'views' => 612,
            ],
            [
                'external_id' => 4,
                'user_id' => 4,
                'title' => 'The only way to do great work is to love what you do',
                'body' => 'The only way to do great work is to love what you do. Passion drives excellence. When you\'re doing something you care about deeply, you bring your whole self to the work. You persist through challenges. You innovate. You inspire others.',
                'tags' => json_encode(['motivation', 'work', 'passion']),
                'likes' => 423,
                'dislikes' => 15,
                'views' => 891,
            ],
            [
                'external_id' => 5,
                'user_id' => 5,
                'title' => 'Be yourself; everyone else is already taken',
                'body' => 'Be yourself; everyone else is already taken. Authenticity is rare and valuable. In a world of copies and imitations, being genuine stands out. Your unique perspective, your voice, your experiences - these are your superpowers. Don\'t dim them down.',
                'tags' => json_encode(['authenticity', 'personal-growth', 'inspiration']),
                'likes' => 334,
                'dislikes' => 11,
                'views' => 734,
            ],
            [
                'external_id' => 6,
                'user_id' => 6,
                'title' => 'The future belongs to those who believe in the beauty of their dreams',
                'body' => 'The future belongs to those who believe in the beauty of their dreams. Dreams are not just fantasies; they\'re blueprints. When you can visualize something clearly, when you believe in it passionately, you begin to take actions that make it real. Vision precedes achievement.',
                'tags' => json_encode(['dreams', 'future', 'vision']),
                'likes' => 456,
                'dislikes' => 22,
                'views' => 987,
            ],
            [
                'external_id' => 7,
                'user_id' => 1,
                'title' => 'It is during our darkest moments that we must focus to see the light',
                'body' => 'It is during our darkest moments that we must focus to see the light. Challenges are part of life. They test us. They strengthen us. They teach us resilience. Those who persist through difficulties often emerge stronger, wiser, more compassionate. Your struggle has meaning.',
                'tags' => json_encode(['resilience', 'challenges', 'growth']),
                'likes' => 267,
                'dislikes' => 7,
                'views' => 598,
            ],
            [
                'external_id' => 8,
                'user_id' => 2,
                'title' => 'The only impossible journey is the one you never begin',
                'body' => 'The only impossible journey is the one you never begin. Every great accomplishment started with a single step. Doubt and fear are natural, but they\'re not insurmountable. Take action. Progress comes from movement, not perfection. Begin now, perfect later.',
                'tags' => json_encode(['action', 'success', 'journey']),
                'likes' => 389,
                'dislikes' => 18,
                'views' => 745,
            ],
        ];

        foreach ($posts as $post) {
            PostModel::create($post);
        }
    }
}
