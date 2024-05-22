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
        Schema::create('supervisors', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();


            // link with users table
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            // link with departments
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
        Schema::dropIfExists('supervisors');
    }
};
