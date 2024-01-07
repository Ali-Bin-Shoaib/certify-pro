<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trainer>
 */
class TrainerFactory extends Factory
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
            'member_id' => Member::pluck('id')->random(),
            'name' => fake()->name,
            'gender' => $gender,
            'phone' => fake()->phoneNumber(),
        ];
    }
}
