<?php

namespace KLC;

class DataFromMemory extends DataChain
{
    protected static $data = [];

    protected function handle(array $params)
    {
        if (!isset(self::$data[$params['type']][$params['slug']])) {
            return false;
        }

        return self::$data[$params['type']][$params['slug']];
    }

    protected function terminate(array $params, $result)
    {
        self::$data[$params['type']][$params['slug']] = $result;

        return $result;
    }
}