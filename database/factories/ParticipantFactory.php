<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participant>
 */
class ParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_id' => Member::pluck('id')->random(),
            'name'=>fake()->name(),
            'gender'=>fake()->randomElement(['ذكر','أنثى']),
            'email' => fake()->unique()->safeEmail(),
            'phone'=> fake()->phoneNumber(),


        ];
    }
}
