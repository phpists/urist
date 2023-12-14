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
            $plans = [
                [Plan::PLAN_LITE_ID, Plan::PLAN_BASE_ID],
                [Plan::PLAN_BASE_ID],
                [Plan::PLAN_LITE_ID]
            ];
            $user->assignRole(User::ROLE_USER);
            $user->plans()->attach($plans[rand(0, 2)]);
        });
    }
}
