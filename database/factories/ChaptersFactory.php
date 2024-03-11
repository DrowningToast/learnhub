<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapters>
 */
class ChaptersFactory extends Factory
{
    private int $course_id;

    public function withCourse(int $course_id): self
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
            "title" => $this->faker->sentence(),
            "description" => $this->faker->paragraph(),
            "course_id" => $this->course_id,
            "durationInMinutes" => $this->faker->numberBetween(0, 240),
            "video_src" => "https://project-itacademy.s3.ap-southeast-1.amazonaws.com/Probability+and+Statistics+4_+Random+Variables.mp4"
        ];
    }
}
