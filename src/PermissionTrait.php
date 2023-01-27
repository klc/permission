<?php

namespace KLC;

use KLC\Models\Role;

trait PermissionTrait
{
    public function roles()
    {
        return $this->belongstoMany(Role::class, 'user_role');
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function hasPermission($slug)
    {
        return hasPermission($slug, $this->id);
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function hasRole($slug)
    {
        return hasRole($slug, $this->id);
    }
}