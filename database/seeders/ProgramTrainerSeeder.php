<?php

namespace Database\Seeders;

use App\Models\ProgramTrainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramTrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramTrainer::factory()->count(10)->create(); 
    }
}
