<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuizScoreByUser>
 */
class QuizScoreByUserFactory extends Factory
{

    private int $quizId;
    private int $userId;

    public function forQuiz(int $quizId): self
    {
        $this->quizId = $quizId;
        return $this;
    }

    public function byUser(int $userId): self
    {
        $this->userId = $userId;
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
            "quiz_id" => $this->quizId,
            "user_id" => $this->userId,
            "answer_data" => json_encode([
                1, 2
            ]),
            "submitted_at" => $this->faker->dateTime(),
            "score" => 1,
        ];
    }
}
