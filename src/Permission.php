<?php

namespace KLC;

use Illuminate\Support\Facades\Auth;

class Permission
{
    public static function hasPermission(string $slug, int $userId = 0)
    {
        if (!$userId) {
            $userId = Auth::user()->id;
        }

        $memory = new DataFromMemory();
        $redis = new DataFromRedis();
        $db = new DataFromDb();
        $memory->next($redis)->next($db);

        return (bool)$memory->run(['slug' => $slug, 'user_id' => $userId, 'type' => 'permission']);
    }

    public static function hasRole(string $slug, int $userId = 0)
    {
        if (!$userId) {
            $userId = Auth::user()->id;
        }

        $memory = new DataFromMemory();
        $redis = new DataFromRedis();
        $db = new DataFromDb();
        $memory->next($redis)->next($db);

        return (bool)$memory->run(['slug' => $slug, 'user_id' => $userId, 'type' => 'role']);
    }
}