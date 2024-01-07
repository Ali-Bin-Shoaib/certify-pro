<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(OrganizationSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            DefaultAdminSeeder::class,
            UserSeeder::class,
            OrganizationSeeder::class,
            MemberSeeder::class,
            CategorySeeder::class,
            TrainerSeeder::class,
            ProgramSeeder::class,
            ParticipantSeeder::class,
            ProgramParticipantSeeder::class,
            ProgramTrainerSeeder::class,
        ]);
    }
}
