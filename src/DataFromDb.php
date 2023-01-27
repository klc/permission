<?php

namespace KLC;

use KLC\Models\RolePermission;
use KLC\Models\UserRole;
use KLC\Models\Permission;
use KLC\Models\Role;

class DataFromDb extends DataChain
{
    protected function handle(array $params)
    {
        $data = [];

        $userRoles = UserRole::where('user_id', $params['user_id'])
            ->get()
            ->keyBy('role_id');

        /** @var Role[] $roles **/
        $roles = Role::all();

        if ($userRoles->isEmpty()) {
            return false;
        }

        $roleIds = [];
        foreach ($roles as $role) {
            if (isset($userRoles[$role->id])) {
                $data['role'][$role->slug] = 1;
                $roleIds[] = $role->id;
            } else {
                $data['role'][$role->slug] = 0;
            }
        }

        $rolePermissions = RolePermission::whereIn('role_id', $roleIds)
            ->get()
            ->keyBy('permission_id');

        /** @var Permission[] $permissions */
        $permissions = Permission::all();


        foreach ($permissions as $permission) {
            if (isset($rolePermissions[$permission->id])) {
                $data['permission'][$permission->slug] = 1;
            } else {
                $data['permission'][$permission->slug] = 0;
            }
        }

        return $data;
    }
}