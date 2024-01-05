<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'organization',
            'username' => 'organization',
            'password' => static::$password ??= Hash::make('org'),
            'email' => 'org@org.org',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'organization',
        ]);
        User::create([
            'name' => 'member',
            'username' => 'member',
            'password' => static::$password ??= Hash::make('member'),
            'email' => 'member@member.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'member',
        ]);
    }
}
