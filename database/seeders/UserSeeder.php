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
            $permissions = [
                [User::PLAN_LITE, User::PLAN_BASE],
                [User::PLAN_BASE],
                [User::PLAN_LITE]
            ];
            $user->assignRole(User::ROLE_USER);
            $user->givePermissionTo($permissions[rand(0, 2)]);
        });
    }
}
