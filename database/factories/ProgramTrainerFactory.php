<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Participant;
use App\Models\Program;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgramTrainer>
 */
class ProgramTrainerFactory extends Factory
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
            'trainer_id' => Trainer::pluck('id')->random(),
            // 'created_by' => Member::pluck('id')->random(),

        ];
    }
}
