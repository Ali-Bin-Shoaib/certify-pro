<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected static ?string $password;

    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => static::$password ??= Hash::make('admin'),
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'admin',
        ]);
        $orgUser = User::create([
            'name' => 'organization',
            'username' => 'organization',
            'password' => static::$password ??= Hash::make('org'),
            'email' => 'org@org.org',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'organization',
        ]);
        $org=Organization::create([
            'user_id' => $orgUser->id,
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber()
        ]);
        $member = User::create([
            'name' => 'member',
            'username' => 'member',
            'password' => static::$password ??= Hash::make('member'),
            'email' => 'member@member.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'member',
        ]);
        Member::create([
            'user_id' => $member->id,
            'organization_id' => $org->id,
            'job_title' => fake()->randomElement(['مدير', 'نائب مدير', 'رئيس قسم', 'مدير مشروع', 'منسق', 'عضو']),

        ]);
    }
}
