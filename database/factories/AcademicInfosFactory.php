<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicInfos>
 */
class AcademicInfosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "school" => $this->faker->company(),
            "institute" => $this->faker->company(),
            "campus" => $this->faker->company(),
            "year" => $this->faker->numberBetween(1, 8),
        ];
    }
}
