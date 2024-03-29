<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static ?string $password;

    public function definition(): array
    {
// dd(User::where('role', 'member')->pluck('id')->random());
        return [
            // 'name' => fake()->name(),
            'user_id' => User::where('role', 'member')->pluck('id')->random(),
            'organization_id' => Organization::pluck('id')->random(),
            // 'job_title' => fake()->jobTitle(),
            'job_title' => fake()->randomElement(['مدير', 'نائب مدير', 'رئيس قسم', 'مدير مشروع', 'منسق', 'عضو']),

        ];
    }
}
