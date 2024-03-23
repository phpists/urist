<?php

namespace App\Services;

class PermissionService
{

    public static function authorize(string $action): void
    {
        if (!can_user($action))
            abort(403);
    }

}
