<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\ProgramParticipant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramParticipant::factory()->count(10)->create();
    }
}
