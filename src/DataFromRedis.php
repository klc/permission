<?php

namespace KLC;

use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Facades\Redis;

class DataFromRedis extends DataChain
{
    /** @var Connection */
    protected static $client;
    protected string $key = 'klc_permission:%s:%s';
    protected string $tempKey = 'klc_permission_temp:%s:%s';

    public function __construct()
    {
        if (!self::$client) {
            self::$client = Redis::connection();
            self::$client->setName('permission');
        }
    }

    protected function handle(array $params)
    {
        $data = self::$client->hget(sprintf($this->key, $params['user_id'], $params['type']), $params['slug']);

        if ($data === false) {
            return false;
        }

        return (int)$data;
    }

    protected function terminate(array $params, $result)
    {
        foreach ($result as $type => $permissions) {
            foreach ($permissions as $slug => $hasPermission) {
                self::$client->hset(sprintf($this->tempKey, $params['user_id'], $type), $slug, $hasPermission);
            }
        }

        self::$client->rename(
            sprintf($this->tempKey, $params['user_id'], $params['type']),
            sprintf($this->key, $params['user_id'], $params['type'])
        );

        return $result[$params['type']][$params['slug']] ?? false;
    }
}