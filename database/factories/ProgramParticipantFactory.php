<?php

namespace Database\Factories;

use App\Models\Participant;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgramParticipant>
 */
class ProgramParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'program_id' => Program::pluck('id')->random(),
            'participant_id' => Participant::pluck('id')->random(),

        ];
    }
}
