<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(), // Overridden automatically by the ->has() chain
            'author_id' => User::factory(), // Overridden automatically by the ->recycle() chain
            'body' => $this->faker->paragraph(),
        ];
    }
}
