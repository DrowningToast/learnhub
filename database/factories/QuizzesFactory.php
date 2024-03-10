<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class QuizzesFactory extends Factory
{

    private int $chapterId;

    public function inChapter(int $courseId): self
    {
        $this->chapterId = $courseId;
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
            "chapter_id" => $this->chapterId,
            "title" => $this->faker->sentence(),
            "description" => $this->faker->paragraph(),
            "quiz_data" => json_encode([
                    [
                        "question" => "What is 1 + 1?",
                        "options" => [
                            "1",
                            "2",
                            "3",
                            "4",
                        ],
                        "answer" => "2",
                    ],
                    [
                        "question" => "What is 2 + 2?",
                        "options" => [
                            "1",
                            "2",
                            "3",
                            "4",
                        ],
                        "answer" => "4",
                    ],
            ]),
        ];
    }
}
