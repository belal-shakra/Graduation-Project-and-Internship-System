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
        Schema::create('weekly_followings', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();

            $table->string('task');
            $table->smallInteger('hour');
            $table->text('description');
            $table->smallInteger('week');

            $table->bigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_followings');
    }
};
