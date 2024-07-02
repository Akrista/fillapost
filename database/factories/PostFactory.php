<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'status' => $this->faker->randomElement(['draft', 'scheduled', 'published', 'failed']),
            'internal_id' => $this->faker->uuid,
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => 1,
            'service_account_id' => 1,
        ];
    }
}
