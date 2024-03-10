<?php

use App\Enums\CourseCategoryEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->string("description")->nullable();
            $table->string("cover_image_src")->nullable();
            $table->float("buy_price");
            $table->integer("buy_point")->nullable();
            $table->float("discount_percent");
            $table->integer("hidden")->default(0);

            $table->unsignedBigInteger("lecturer_id");
            $table->foreign("lecturer_id")->references("id")->on("users")->onDelete("cascade");

            // Course Category 1: SCIENCE, 2:MATH, 3:THAI, 4:SOCIAL STUDY, 5:ENGLISH 6:IT
            $table->enum("category_id", CourseCategoryEnum::values())->default(CourseCategoryEnum::SCIENCE);

            $table->dateTime("deleted_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
