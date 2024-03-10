<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseByUser>
 */
class CourseByUserFactory extends Factory
{

    private int $userId;
    private int $courseId;

    public function fromUser(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function withCourse(int $courseId): self
    {
        $this->courseId = $courseId;
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
            "user_id" => $this->userId,
            "course_id" => $this->courseId,
            "enrolled_at" => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
        ];
    }
}
