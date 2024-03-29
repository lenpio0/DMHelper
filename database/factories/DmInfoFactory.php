<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DmInfo>
 */
class DmInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'info' => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
            'table_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
