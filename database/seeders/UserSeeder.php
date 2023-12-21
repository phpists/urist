<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            $roles = [
                User::ROLE_LITE,
                User::ROLE_BASE,
                User::ROLE_ADMIN,
                User::ROLE_USER
            ];
            $user->assignRole($roles[array_rand($roles)]);
        });
    }
}
