<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween("now", "+10 months");
        return [
            'member_id' => 1,
            'category_id' => Category::pluck('id')->random(),
            'title' => fake()->word,
            'location' => fake()->address(),
            'start_date' => $startDate,
            'end_date' => fake()->dateTimeBetween($startDate, '+10 months')

        ];
    }
}
