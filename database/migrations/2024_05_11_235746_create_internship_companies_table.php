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
        Schema::create('internship_companies', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();

            $table->string('company_name');
            $table->string('address');

            $table->date('starting_date');
            $table->date('ending_date');

            $table->string('supervisor_name');
            $table->string('email_name');

            $table->text('description');
            $table->text('technologies');


            $table->bigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->text('supervisor_note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_companies');
    }
};
