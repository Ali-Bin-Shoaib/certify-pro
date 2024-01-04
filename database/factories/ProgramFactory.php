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
        return [
            'member_id' => Member::pluck('id')->random(),
            'category_id'=>Category::pluck('id')->random(),
            'title'=> fake()->title,
            'location'=>fake()->address(),
            'start_date'=>fake()->dateTimeBetween('now','+10 months'),
            'end_date'=>fake()->dateTimeBetween('now','+10 months')

        ];
    }
}
