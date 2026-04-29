<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define which models are "imageable"
        $imageables = [User::class, Post::class];

        // Pick one randomly
        $imageableType = $this->faker->randomElement($imageables);

        return [
            'url' => $this->faker->imageUrl(640, 480, 'animals', true),
            'imageable_type' => $imageableType,
            // Grab a random existing ID from the chosen model's table
            'imageable_id' => $imageableType::inRandomOrder()->first()?->id ?? $imageableType::factory(),
        ];
    }
}
