<?php

use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
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
            $table->string("first_name")->nullable()->default("");
            $table->string("last_name")->nullable()->default("");
            $table->integer("points")->nullable();
            $table->string("bankName")->nullable()->default("");
            $table->string("accountNumber")->nullable()->default("");

            $table->enum("role", RoleEnum::values())->default(RoleEnum::Learner);

            $table->unsignedBigInteger("credential_id")->unique();
            $table->foreign("credential_id")->references("id")->on("credentials")->onDelete("cascade");

            $table->unsignedBigInteger("academic_id")->unique();
            $table->foreign("academic_id")->references("id")->on("academic_infos")->onDelete("cascade");

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
