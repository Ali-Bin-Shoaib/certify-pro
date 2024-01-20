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
        $gender = fake()->randomElement(['ذكر', 'أنثى']);
        if ($gender == 'ذكر')
            $name = fake()->name('male');
        else
            $name = fake()->name('female');

        return [
            'member_id' => 1,
            'name' => $name,
            'gender' => $gender,
            'email' => fake()->unique()->email(),
            'phone' => fake()->phoneNumber(),


        ];
    }
}
