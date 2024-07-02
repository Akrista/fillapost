<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\ServiceAccount;
use App\Models\SocialMediaService;
use Database\Factories\SocialMediaTypeFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'demo',
            'email' => 'demo@fillapost.com',
            'password' => '$2y$12$kvyQkhYGvz6L9Dk.GM0CEO9bZE1bmxhfH6DEFFE5XD9Gcm1wDhGP2',
        ]);

        SocialMediaTypeFactory::new()->createMany([
            ['type' => 'linkedin'],
            ['type' => 'openai'],
            ['type' => 'wakatime'],
            ['type' => 'steam']
        ]);

        SocialMediaService::factory()->create(
            [
                'social_media_type_id' => '1',
                'token' => '$2y$12$kvyQkhYGvz6L9Dk.GM0CEO9bZE1bmxhfH6DEFFE5XD9Gcm1wDhGP2',
                'client_id' => '$2y$12$kvyQkhYGvz6L9Dk.GM0CEO9bZE1bmxhfH6DEFFE5XD9Gcm1wDhGP2',
                'client_secret' => '$2y$12$kvyQkhYGvz6L9Dk.GM0CEO9bZE1bmxhfH6DEFFE5XD9Gcm1wDhGP2',
                'user_id' => 1
            ]
        );
        ServiceAccount::factory()->create(
            [
                'social_media_service_id' => 1,
                'name' => 'demo',
                'avatar' => 'https://via.placeholder.com/150',
                'internal_id' => 'demo'
            ]
        );
        Post::factory(100)->create();
    }
}
