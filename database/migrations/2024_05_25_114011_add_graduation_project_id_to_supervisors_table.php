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
        Schema::table('supervisors', function (Blueprint $table) {
            $table->bigInteger('graduation_project_id')->nullable()->after('user_id');
            $table->foreign('graduation_project_id')->references('id')->on('graduation_projects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supervisors', function (Blueprint $table) {
            //
        });
    }
};
