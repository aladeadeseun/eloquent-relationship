<?php

namespace Database\Factories;

use App\Models\PolymorphicComment;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PolymorphicComment>
 */
class PolymorphicCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // List of models that can have comments
        $commentables = [Post::class, Video::class];
        $type = $this->faker->randomElement($commentables);

        return [
            'body' => $this->faker->paragraph(),
            'commentable_type' => $type,
            // It tries to find an existing record of that type, or creates one if empty
            'commentable_id' => $type::inRandomOrder()->first()?->id ?? $type::factory(),
        ];
    }
}
