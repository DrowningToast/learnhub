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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string("profile_image_src")->nullable();
            $table->string("email");
            $table->string("phone")->nullable();
            $table->string("first_name");
            $table->string("last_name");
            $table->integer("points")->nullable();
            $table->string("role_id");

            $table->unsignedBigInteger("credential_id")->unique();
            $table->foreign("credential_id")->references("id")->on("credentials")->onDelete("cascade");

            $table->unsignedBigInteger("academic_id")->unique();
            $table->foreign("academic_id")->references("id")->on("academic_info")->onDelete("cascade");

            $table->dateTime("banned_at")->nullable();

            $table->rememberToken();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
