<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\Models\PostModel;
use App\Infrastructure\Persistence\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = PostModel::class;

    public function definition(): array
    {
        return [
            'external_id' => $this->faker->unique()->numberBetween(1, 10000),
            'user_id' => UserModel::factory(),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraphs(3, true),
            'tags' => $this->faker->words(3),
            'likes' => $this->faker->numberBetween(0, 100),
            'dislikes' => $this->faker->numberBetween(0, 50),
            'views' => $this->faker->numberBetween(10, 1000),
        ];
    }
}
