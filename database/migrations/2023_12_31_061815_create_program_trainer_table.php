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
        Schema::create('program_trainer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs', 'id');
            $table->foreignId('trainer_id')->constrained('trainers', 'id');
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
