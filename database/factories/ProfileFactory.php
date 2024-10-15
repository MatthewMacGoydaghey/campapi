<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user' => fake()->numberBetween(1, 100),
            'name' => fake()->name(),
            "description" => fake()->text(30),
            "scores" => fake()->numberBetween(0, 25),
            'position' => "PARTICIPANT"
        ];
    }
}
