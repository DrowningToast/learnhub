<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Files>
 */
class FilesFactory extends Factory
{
    private int $chapter_id;
    public function inChapter (int $chapter_id): self
    {
        $this->chapter_id = $chapter_id;
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
            "file_path" => $this->faker->imageUrl(),
            "file_name" => $this->faker->words(2, true),
            "chapter_id" => $this->chapter_id
        ];
    }
}
