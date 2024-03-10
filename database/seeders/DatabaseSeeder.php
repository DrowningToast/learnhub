<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\RoleEnum;
use App\Models\Chapters;
use App\Models\Courses;
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

        $learnerBots = Users::factory(10)->create();
        $lecturerBots = Users::factory(5)->withRole(RoleEnum::Lecturer)->create();

        foreach ($lecturerBots as $bot) {
            // Generate 4 courses for each lecturer
            $courses = Courses::factory(4)->withLecturer($bot->id)->create();
            foreach ($courses as $course) {
                // Generate 5 chapters for each course
                Chapters::factory(5)->withCourse($course->id)->create();
            }
        }

    }
}
