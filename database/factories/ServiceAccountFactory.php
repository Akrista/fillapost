<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class ServiceAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'social_media_service_id' => 1,
            'name' => $this->faker->name,
            'avatar' => $this->faker->imageUrl(),
            'internal_id' => $this->faker->uuid,
        ];
    }
}
