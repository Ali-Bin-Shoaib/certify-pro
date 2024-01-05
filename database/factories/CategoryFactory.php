<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement(['تطوير الذات', 'برمجية', 'علمية', 'لغة إنجليزية', 'مهنية', 'ثقافية']),
            'member_id' => Member::pluck('id')->random()
        ];
    }
}
