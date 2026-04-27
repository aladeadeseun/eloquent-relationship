<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Environment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Environment>
 */
class EnvironmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>$this->faker->randomElement(['Production', 'Staging', 'QA', 'Development']),
            "application_id"=>Application::factory()
        ];
    }
}
