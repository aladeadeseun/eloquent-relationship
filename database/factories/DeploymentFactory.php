<?php

namespace Database\Factories;

use App\Models\Deployment;
use App\Models\Environment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Deployment>
 */
class DeploymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'status' => $this->faker->randomElement(['success', 'failed']),
            'commit_hash' => $this->faker->sha1(),
            'status' => $this->faker->randomElement(['success', 'failed', 'pending']),
            'environment_id' => Environment::factory(),
        ];
    }
}
