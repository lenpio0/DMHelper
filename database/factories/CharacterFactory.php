<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $health = $this->faker->numberBetween(1, 12);
        return [
            'name' => $this->faker->name(),
            'max_health' => $health,
            'act_health' => $health
        ];
    }
}
