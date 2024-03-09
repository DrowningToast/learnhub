<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\RoleEnum;
use App\Models\Credentials;
use App\Models\Users;
use Database\Factories\UsersFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $learnerCred = Credentials::factory()->create([
            "username" => "learner",
            "password" => bcrypt("password"),
        ]);

        $learner = Users::factory()->create([
            "credential_id" => $learnerCred->id,
            "role" => RoleEnum::Learner,
        ]);

        $bots = Users::factory(10)->create();

        $lecturerCred = Credentials::factory()->create([
            "username" => "lecturerA",
            "password" => bcrypt("password"),
        ]);

        $lecturer = Users::factory()->create([
            "credential_id" => $lecturerCred->id,
            "role" => RoleEnum::Lecturer,
        ]);

        $moderatorCred = Credentials::factory()->create([
            "username" => "moderatora",
            "password" => bcrypt("password"),
        ]);

        $admin = Users::factory()->create([
            "credential_id" => $moderatorCred->id,
            "role" => RoleEnum::Moderator,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User::create
    }
}
