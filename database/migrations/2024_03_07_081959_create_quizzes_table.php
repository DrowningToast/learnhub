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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("course_id")->unique();
            $table->foreign("course_id")->references("id")->on("courses")->onDelete("cascade");
            $table->string("title");
            $table->longText("description")->nullable();
            $table->json("quiz_data");
            $table->float("full_score");
            $table->dateTime("expired_at");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
