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
        Schema::create('graduation_projects', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->smallInteger('semester');

            // project info
            $table->string('type');
            $table->string('name');
            $table->string('idea');
            $table->string('goal');
            $table->string('technologies');

            // department
            $table->bigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation_projects');
    }
};
