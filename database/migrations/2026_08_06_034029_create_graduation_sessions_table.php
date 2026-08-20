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
        Schema::create('graduation_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('graduation_event_id')->constrained('graduation_events')->onDelete('cascade');
            $table->date('date');
            $table->tinyInteger('session')->nullable();
            $table->enum('status',['draft','published','archived']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation_sessions');
    }
};
