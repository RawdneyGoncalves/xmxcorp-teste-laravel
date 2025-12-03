<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\Models\CommentModel;
use App\Infrastructure\Persistence\Models\PostModel;
use App\Infrastructure\Persistence\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = CommentModel::class;

    public function definition(): array
    {
        return [
            'external_id' => $this->faker->unique()->numberBetween(1, 100000),
            'post_id' => PostModel::factory(),
            'user_id' => UserModel::factory(),
            'body' => $this->faker->paragraph(),
            'likes' => $this->faker->numberBetween(0, 50),
        ];
    }
}
