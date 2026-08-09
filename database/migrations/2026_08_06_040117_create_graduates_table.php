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
        Schema::create('graduates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('graduation_session_id')->constrained('graduation_sessions');
            $table->foreignId('faculty_id')->constrained('faculties');
            $table->foreignId('study_program_id')->constrained('study_programs');
            $table->string('nrp');
            $table->string('name');
            $table->foreignId('seat_id')->constrained('seats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduates');
    }
};
