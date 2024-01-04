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
        Schema::create('program_trainers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs', 'id')->cascadeOnDelete();
            $table->foreignId('trainer_id')->constrained('trainers', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_trainer');
    }
};
