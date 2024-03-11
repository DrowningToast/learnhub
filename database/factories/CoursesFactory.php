<?php

namespace Database\Factories;

use App\Enums\RoleEnum;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courses>
 */
class CoursesFactory extends Factory
{

    private int $lecturer_id;

    /**
     * Set the lecturer_id for the course
     */
    public function withLecturer(int $lecturer_id): self
    {
        $this->lecturer_id = $lecturer_id;
        return $this;
    }

    /**
     * Create new lecturer and set the lecturer_id for the course
     */
    public function withNewLecturer(): self
    {
        $this->lecturer_id = Users::factory()->withRole(RoleEnum::Lecturer)->create()->id;
        return $this;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->sentence(),
            "description" => $this->faker->paragraph(4),
            "cover_image_src" => $this->faker->imageUrl(),
            "buy_price" => $this->faker->randomFloat(1, 0, 1000),
            "buy_point" => $this->faker->numberBetween(0, 1000),
            "discount_percent" => rand(0, 1) > 0.5 ? $this->faker->randomFloat(1, 0, 100) : 0,
            "hidden" => rand(0, 1) > 0.8 ? 1 : 0,
            "lecturer_id" => $this->lecturer_id,
            "category_id" => $this->faker->numberBetween(1, 6)
        ];
    }
}
