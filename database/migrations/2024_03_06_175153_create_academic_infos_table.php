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
        Schema::create('academic_infos', function (Blueprint $table) {
            $table->id();

            $table->string("school")->default("Unaffiliated");
            $table->string("institute")->nullable();
            $table->string("campus")->nullable();
            $table->integer("year")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_infos');
    }
};
