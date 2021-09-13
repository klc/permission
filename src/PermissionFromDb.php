<?php

namespace KLC;

use KLC\Models\RolePermission;
use KLC\Models\UserRole;
use KLC\Models\Permission;

class PermissionFromDb extends DataChain
{

    protected function handle(array $params)
    {
        $userRole = UserRole::where('user_id', $params['user_id'])->first();

        if (!$userRole) {
            return false;
        }

        $rolePermissions = RolePermission::where('role_id', $userRole->role_id)->get()->keyBy('permission_id');
        $permissions = Permission::all();

        $hasPermission = [];

        foreach ($permissions as $permission) {
            if (isset($rolePermissions[$permission->id])) {
                $hasPermission[$permission->slug] = 1;
            } else {
                $hasPermission[$permission->slug] = 0;
            }
        }

        return $hasPermission;
    }
}