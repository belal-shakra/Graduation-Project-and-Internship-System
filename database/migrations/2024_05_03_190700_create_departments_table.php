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
        Schema::create('departments', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();

            $table->string('name');
            $table->smallInteger('no_team_member');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->smallInteger('week');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
