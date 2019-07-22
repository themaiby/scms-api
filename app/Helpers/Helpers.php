<?php

use App\Enums\PermissionType;

if (!function_exists('permissionMiddleware')) {
    function permissionMiddleware(PermissionType $permission)
    {
        return 'permission:' . $permission;
    }
}
