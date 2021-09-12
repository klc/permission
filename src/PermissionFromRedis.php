<?php

namespace KLC;

use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Facades\Redis;

class PermissionFromRedis extends DataChain
{
    /** @var Connection */
    protected static $client;

    public function __construct()
    {
        if (!self::$client) {
            self::$client = Redis::connection();
            self::$client->setName('permission');
        }
    }

    protected function handle(array $params)
    {
        $permission = self::$client->hget('permissions:'.$params['user_id'], $params['slug']);

        if ($permission === false) {
            return false;
        }

        return (int)$permission;
    }

    protected function terminate(array $params, $result)
    {
        foreach ($result as $slug => $hasPermission) {
            self::$client->hset('permissions_temp:'.$params['user_id'], $slug, $hasPermission);
        }

        self::$client->rename('permissions_temp:'.$params['user_id'], 'permissions:'.$params['user_id']);

        return $result[$params['slug']];
    }
}