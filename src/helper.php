<?php

if (!function_exists('hasPermission')) {
    function hasPermission($slug, $userId = 0) {
      return \KLC\Permission::hasPermission($slug, $userId);
    }
}