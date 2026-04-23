<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Fetch all your existing users from the previous run
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->error('No users found in the database. Please seed users first!');
            return;
        }

        // 2. Loop to ensure a unique random count per post
        for ($i = 0; $i < 10; $i++) {
            Post::factory()
                // Picks a random user from your existing collection
                ->recycle($users) 
                // Generates a random number of comments between 2 and 8 for THIS specific post
                ->has(Comment::factory()->count(rand(2, 8))) 
                ->create();
        }
    }
}
