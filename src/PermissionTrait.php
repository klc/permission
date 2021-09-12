<?php

namespace KLC;

use KLC\Permission\Models\Role;

trait PermissionTrait
{
    public function role()
    {
        return $this->hasOne(Role::class);
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function can($slug)
    {
        return hasPermission($slug, $this->id);
    }
}