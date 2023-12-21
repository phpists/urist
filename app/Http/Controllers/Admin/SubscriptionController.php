<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermissionUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubscriptionController extends Controller
{
    public function index() {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.subscriptions.index', compact('roles', 'permissions'));
    }

    public function updateRolePermission(RolePermissionUpdateRequest $request): \Illuminate\Http\JsonResponse
    {
        $role = Role::query()->find($request->role_id);
        $permission = Permission::query()->find($request->permission_id);
        if ($request->is_active) {
            $role->givePermissionTo($permission);
        }
        else {
            $role->revokePermissionTo($permission);
        }
        return response()->json([
            'message' => 'Дозвіл успішно оновлений'
        ]);
    }
}
