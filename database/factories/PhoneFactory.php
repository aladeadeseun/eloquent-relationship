<?php

namespace Database\Factories;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Attributes\UseModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Phone>
 */
#[UseModel(Phone::class)]
class PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // This auto-creates a User if one is not provided
            'user_id' => User::factory(), 
            'phone_number' => $this->faker->phoneNumber(),
            'model'=>$this->faker->word()
        ];
    }
}
