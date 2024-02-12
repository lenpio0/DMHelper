<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buff>
 */
class BuffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'desc' => $this->faker->realText($maxNbChars = 100, $indexSize = 2),
            'is_debuff' => $this->faker->boolean(),
        ];
    }
}
