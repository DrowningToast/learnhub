<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger("user_id")->unique()->nullable();
            // $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

            // $table->unsignedBigInteger("bank_id")->unique()->nullable();
            // $table->foreign("bank_id")->references("id")->on("banks")->onDelete("cascade");

            $table->foreignId("user_id")->constrained('users', 'id')->onDelete("cascade");

            $table->float("amount");
            $table->integer("status_id")->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
