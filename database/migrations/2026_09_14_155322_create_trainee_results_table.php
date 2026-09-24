<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainee_results', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->integer('score');
            $table->integer('hazards_found');
            $table->integer('hazards_missed');
            $table->float('completion_time'); // stored in seconds
            $table->string('performance_rating'); // e.g., "Locked In", "Great", "Cooked"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainee_results');
    }
};
