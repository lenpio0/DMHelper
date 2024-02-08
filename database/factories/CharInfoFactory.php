<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CharInfo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CharInfo>
 */
class CharInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'info' => $this->faker->paragraph(2),
            'is_secret' => $this->faker->boolean(),
            'character_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
