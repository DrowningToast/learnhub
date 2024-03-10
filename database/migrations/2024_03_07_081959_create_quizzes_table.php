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

            $table->unsignedBigInteger("chapter_id")->unique();
            $table->foreign("chapter_id")->references("id")->on("chapters")->onDelete("cascade");
            $table->string("title");
            $table->longText("description")->nullable();
            $table->json("quiz_data");
            $table->dateTime("expired_at")->nullable();

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
