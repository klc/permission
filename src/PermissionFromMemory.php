<?php

namespace KLC;

class PermissionFromMemory extends DataChain
{
    protected static $permissions = [];

    protected function handle(array $params)
    {
        if (!isset(self::$permissions[$params['slug']])) {
            return false;
        }

        return self::$permissions[$params['slug']];
    }

    protected function terminate(array $params, $result)
    {
        self::$permissions[$params['slug']] = $result;

        return $result;
    }
}