<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\RoleEnum;
use App\Models\Chapters;
use App\Models\Courses;
use App\Models\Credentials;
use App\Models\Reviews;
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
        $learnerBots = Users::factory(100)->create();
        $lecturerBots = Users::factory(5)->withRole(RoleEnum::Lecturer)->create();
        $moderatorBots = Users::factory(5)->withRole(RoleEnum::Moderator)->create();

        foreach ($lecturerBots as $i => $bot) {
            // Generate 4 courses for each lecturer
            $courses = Courses::factory(4)->withLecturer($bot->id)->create();
            foreach ($courses as $k => $course) {
                // Generate 5 chapters for each course
                Chapters::factory(5)->withCourse($course->id)->create();
                // Generate 25 reviews for each course
                for ($j = 0; $j < 25; $j++) {
                    Reviews::factory()->fromUser($learnerBots[(25 * $k) + $j]->id)->inCourse($course->id)->create();
                }
            }
        }

        // Login stuff
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

    }
}
