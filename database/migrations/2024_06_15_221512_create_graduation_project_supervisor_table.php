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
        Schema::create('graduation_project_supervisor', function (Blueprint $table) {
            $table->bigInteger('id', true);

            $table->bigInteger('supervisor_id');
            $table->foreign('supervisor_id')->references('id')->on('supervisors')
            ->constrained()->onDelete('cascade');


            $table->bigInteger('graduation_project_id');
            $table->foreign('graduation_project_id')->references('id')->on('graduation_projects')
            ->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation_project_supervisor');
    }
};
