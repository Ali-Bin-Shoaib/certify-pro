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
        Schema::create('program_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs', 'id')->cascadeOnDelete();
            $table->foreignId('participant_id')->constrained('participants', 'id')->cascadeOnDelete();
            $table->string('certificate_id')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('members', 'id')->nullOnDelete();
            $table->timestamps();

            $table->unique(['program_id', 'participant_id']); // Unique constraint

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_participant');
    }
};
