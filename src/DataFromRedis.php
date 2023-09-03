<?php

namespace KLC;

use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Facades\Redis;

class DataFromRedis extends DataChain
{
    /** @var Connection */
    protected static $client;
    public static string $key = 'klc_permission:%s:%s'; //args $userId, $type
    public static string $tempKey = 'klc_permission_temp:%s:%s'; //args $userId, $type

    public function __construct()
    {
        if (!self::$client) {
            self::$client = Redis::connection();
            self::$client->setName('permission');
        }
    }

    protected function handle(array $params)
    {
        $data = self::$client->hget(sprintf(self::$key, $params['user_id'], $params['type']), $params['slug']);

        if ($data === false) {
            return false;
        }

        return (int)$data;
    }

    protected function terminate(array $params, $result)
    {
        foreach ($result as $type => $permissions) {
            foreach ($permissions as $slug => $hasPermission) {
                self::$client->hset(sprintf(self::$tempKey, $params['user_id'], $type), $slug, $hasPermission);
            }
        }

        self::$client->rename(
            sprintf(self::$tempKey, $params['user_id'], $params['type']),
            sprintf(self::$key, $params['user_id'], $params['type'])
        );

        return $result[$params['type']][$params['slug']] ?? false;
    }
}