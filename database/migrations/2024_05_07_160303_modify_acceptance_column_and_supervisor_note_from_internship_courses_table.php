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
        Schema::table('internship_courses', function (Blueprint $table) {
            $table->text('supervisor_note')->nullable()->change();
            $table->boolean('acceptance')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('internship_courses', function (Blueprint $table) {
            //
        });
    }
};
