<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class SocialMediaServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'social_media_type_id' => 1,
            'name' => $this->faker->name,
            'token' => Hash::make('password'),
            'client_id' => Hash::make('password'),
            'client_secret' => Hash::make('password'),
            'user_id' => 1
        ];
    }
}
