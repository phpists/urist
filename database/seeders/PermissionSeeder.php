<?php

namespace Database\Seeders;

use App\Enums\Permissions;
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
        collect(Permissions::cases())->each(fn($plan)=> Permission::create(['name'=>$plan->value]));
    }
}
