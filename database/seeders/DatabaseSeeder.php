<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Files;
use App\Models\Users;
use App\Enums\RoleEnum;
use App\Models\Courses;
use App\Models\Quizzes;
use App\Models\Reviews;
use App\Models\Chapters;
use App\Models\Credentials;
use App\Models\CourseByUser;
use App\Models\Transactions;
use App\Models\QuizScoreByUser;
use Illuminate\Database\Seeder;
use Database\Factories\UsersFactory;
use App\Models\ProgressByUserByCourse;

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
            // Generate a quiz for each course
            
            foreach ($courses as $k => $course) {
                // Generate 5 chapters for each course
                $chapters = Chapters::factory(10)->withCourse($course->id)->create();
                foreach($chapters as $index => $chapter) {
                    $random = rand(0, 10);
                    if ($random > 7) {
                        continue;
                    }
                    // Mock files for each chapter
                    Files::factory()->inChapter($chapter->id)->create();
                }

                // Generate 25 reviews and transaction for each course
                for ($j = 0; $j < 25; $j++) {
                    $price = $course->buy_price * (1 - $course->discount_percent / 100);
                    // Generate transaction (buying)
                    Transactions::factory()->fromUser($learnerBots[(25 * $k) + $j]->id)->withCourse($course->id)->withPrice($price)->create();
                    // Generate Ownership
                    CourseByUser::factory()->fromUser($learnerBots[(25 * $k) + $j]->id)->withCourse($course->id)->create();
                    // Generate review
                    Reviews::factory()->fromUser($learnerBots[(25 * $k) + $j]->id)->inCourse($course->id)->create();
                    // Generate random amount of progress (0 - 10) for each course
                    $progress = rand(0, 10);
                    for ($p = 0; $p < $progress; $p++) {
                        ProgressByUserByCourse::factory()->forUser($learnerBots[(25 * $k) + $j]->id)->forCourse($course->id)->forChapter($chapters[$p]->id)->create();
                    }
                }
                // Generate a quiz for each chapter
                foreach ($chapters as $chapter) {
                    $quiz = Quizzes::factory()->inChapter($chapter->id)->create();
                    // Generate 25 quiz score for each quiz
                    for ($j = 0; $j < 25; $j++) {
                        $quizScore = QuizScoreByUser::factory()->forQuiz($quiz->id)->byUser($learnerBots[(25 * $k) + $j]->id)->create();
                    }
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
            "username" => "lecturer",
            "password" => bcrypt("password"),
        ]);
        
        $lecturer = Users::factory()->create([
            "credential_id" => $lecturerCred->id,
            "role" => RoleEnum::Lecturer,
        ]);
        
        $moderatorCred = Credentials::factory()->create([
            "username" => "moderator",
            "password" => bcrypt("password"),
        ]);
        
        $admin = Users::factory()->create([
            "credential_id" => $moderatorCred->id,
            "role" => RoleEnum::Moderator,
        ]);

    }
}
