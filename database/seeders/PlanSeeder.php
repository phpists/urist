<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = collect(['lite', 'base']);
        $plans->each(fn($plan) => Plan::create(['name' => $plan]));
    }
}
