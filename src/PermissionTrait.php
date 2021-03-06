<?php

namespace KLC;

use KLC\Models\Role;

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
    public function hasPermission($slug)
    {
        return hasPermission($slug, $this->id);
    }
}