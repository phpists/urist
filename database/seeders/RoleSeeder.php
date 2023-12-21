<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = collect([User::ROLE_ADMIN, User::ROLE_BASE, User::ROLE_LITE, User::ROLE_USER]);
        $roles->map(fn($role) => Role::create(['name' => $role]));
    }
}
