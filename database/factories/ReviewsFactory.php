<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reviews>
 */
class ReviewsFactory extends Factory
{

    private int $user_id;
    private int $course_id;

    public function fromUser(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function inCourse(int $course_id): self
    {
        $this->course_id = $course_id;
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
            //
            "user_id" => $this->user_id,
            "course_id" => $this->course_id,
            "rating" => $this->faker->numberBetween(1, 5),
            "comment" => rand(0, 10) > 5 ? $this->faker->paragraph() : null,
        ];
    }
}
