<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'phone' => fake()->phoneNumber(),
            'email' => 'admin@mail.com',
            'birth_date' => now(),
            'city' => fake()->city(),
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole(User::ROLE_ADMIN);
        $user->plans()->attach([Plan::PLAN_LITE_ID, Plan::PLAN_BASE_ID]);
    }
}
