<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionsFactory extends Factory
{

    private int $fromUserId;
    private int $courseId;
    private float $price;

    public function fromUser(int $fromUserId): self
    {
        $this->fromUserId = $fromUserId;
        return $this;
    }

    public function withCourse(int $courseId): self
    {
        $this->courseId = $courseId;
        return $this;
    }

    public function withPrice(float $price): self
    {
        $this->price = $price;
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
            "from_user_id" => $this->fromUserId,
            "course_id" => $this->courseId,
            "amount" => $this->price,
            "stripe_ref_id" => $this->faker->unique()->uuid(),
        ];
    }
}
