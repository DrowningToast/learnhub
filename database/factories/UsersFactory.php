<?php

namespace Database\Factories;

use App\Enums\RoleEnum;
use App\Models\AcademicInfos;
use App\Models\Credentials;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users>
 */
class UsersFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    private RoleEnum $role = RoleEnum::Learner;

    /**
     * Set the role for the user
     */
    public function withRole(RoleEnum $role): self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $cred = Credentials::factory()->create([
            "username" => $this->faker->unique()->userName(),
            "password" => bcrypt("password"),
        ]);

        $academic = AcademicInfos::factory()->create();

        return [
            "first_name" => $this->faker->unique()->firstName(),
            "last_name" => $this->faker->unique()->lastName(),
            "email" => $this->faker->unique()->safeEmail(),
            "phone" => $this->faker->phoneNumber(),
            "profile_image_src" => $this->faker->imageUrl(),
            "points" => $this->faker->numberBetween(0, 1000),
            "role" => $this->role,

            "credential_id" => $cred->id,
            "academic_id" => $academic->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
