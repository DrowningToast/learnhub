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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("from_user_id");
            $table->foreign("from_user_id")->references("id")->on("users")->onDelete("cascade");

            $table->unsignedBigInteger("course_id");
            $table->foreign("course_id")->references("id")->on("courses")->onDelete("cascade");

            $table->float("amount");
            $table->string("stripe_ref_id")->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
