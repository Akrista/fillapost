<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\ServiceAccount;
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
            'password' => '$2y$12$kvyQkhYGvz6L9Dk.GM0CEO9bZE1bmxhfH6DEFFE5XD9Gcm1wDhGP2'
        ]);

        ServiceAccount::factory()->create(
            [
                'type' => 'linkedin',
                'token' => '$2y$12$kvyQkhYGvz6L9Dk.GM0CEO9bZE1bmxhfH6DEFFE5XD9Gcm1wDhGP2',
                'user_id' => 1
            ]
        );
        Post::factory(100)->create();
    }
}
