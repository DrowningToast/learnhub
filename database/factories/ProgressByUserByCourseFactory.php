<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProgressByUserByCourseFactory extends Factory
{

    private int $userId;
    private int $courseId;
    private int $chapterId;

    public function forUser(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function forCourse(int $courseId): self
    {
        $this->courseId = $courseId;
        return $this;
    }

    public function forChapter(int $chapterId): self
    {
        $this->chapterId = $chapterId;
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
            "chapter_id" => $this->chapterId,
        ];
    }
}
