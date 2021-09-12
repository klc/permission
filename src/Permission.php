<?php

namespace KLC;

use Illuminate\Support\Facades\Auth;

class Permission
{
    public static function hasPermission($slug, $userId = 0)
    {
        if (!$userId) {
            $userId = \Illuminate\Support\Facades\Auth::user()->id;
        }

        $memory = new \KLC\PermissionFromMemory();
        $redis = new \KLC\PermissionFromRedis();
        $db = new \KLC\PermissionFromDb();
        $memory->next($redis)->next($db);

        return (bool)$memory->run(['slug' => $slug, 'user_id' => $userId]);
    }
}