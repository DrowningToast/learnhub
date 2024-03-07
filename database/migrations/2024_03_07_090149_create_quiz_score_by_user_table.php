<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_score_by_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("quiz_id")->unique();
            $table->foreign("quiz_id")->references("id")->on("quizzes")->onDelete("cascade");

            $table->unsignedBigInteger("user_id")->unique();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

            $table->string("answer_data");
            $table->dateTime("submitted_at");
            $table->float('score');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_score_by_user');
    }
};
