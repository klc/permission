<?php

if (!function_exists('hasPermission')) {
    function hasPermission(string $slug, int $userId = 0) {
      return \KLC\Permission::hasPermission($slug, $userId);
    }
}

if(!function_exists('hasRole')) {
    function hasRole(string $slug, int $userId = 0) {
        return \KLC\Permission::hasRole($slug, $userId);
    }
}