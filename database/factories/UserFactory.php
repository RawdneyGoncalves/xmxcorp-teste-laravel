<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition(): array
    {
        return [
            'external_id' => $this->faker->unique()->numberBetween(1, 10000),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'image' => $this->faker->imageUrl(),
            'birth_date' => $this->faker->dateTimeBetween('-60 years', '-18 years'),
            'address' => [
                'address' => $this->faker->streetAddress(),
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
                'postalCode' => $this->faker->postcode(),
                'country' => $this->faker->country(),
            ],
        ];
    }
}
