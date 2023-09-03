<?php

namespace KLC;

use Illuminate\Support\Facades\Redis;
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

    public function clearRoleCache()
    {
        /** @var \Redis $redis */
        $redis = Redis::connection();
        $redis->del(sprintf(DataFromRedis::$key, $this->id, 'role'));
        $redis->del(sprintf(DataFromRedis::$tempKey, $this->id, 'role'));
    }

    public function clearPermissionCache()
    {
        /** @var \Redis $redis */
        $redis = Redis::connection();
        $redis->del(sprintf(DataFromRedis::$key, $this->id, 'permission'));
        $redis->del(sprintf(DataFromRedis::$tempKey, $this->id, 'permission'));
    }
}