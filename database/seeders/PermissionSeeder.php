<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([User::PLAN_LITE,User::PLAN_BASE])->each(fn($plan)=> Permission::create(['name'=>$plan]));
    }
}
