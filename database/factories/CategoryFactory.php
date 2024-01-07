<?php

namespace Database\Factories;

use App\Models\Category;
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
        $categories = Category::all('title');
        while (true) {
            $title = fake()->randomElement(['تطوير الذات', 'برمجية', 'علمية', 'لغة إنجليزية', 'مهنية', 'ثقافية','عامة']);
            if ($categories->find('title', $title) != null) {
                break;
            }
        }


        return [
            'title' => $title,
            'member_id' => Member::pluck('id')->random()
        ];
    }
}
