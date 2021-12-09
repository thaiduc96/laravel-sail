<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    public static function getBranchId($guard = GUARD_ADMIN_API)
    {
        $user = self::getGuardApi($guard)->user();
        return $user->branch_id;
    }

    public static function getBranch($guard = GUARD_ADMIN_API)
    {
        $user = self::getGuardApi($guard)->user();
        return $user->branch;
    }

    public static function getUserApi($guard = GUARD_ADMIN_API)
    {
        return self::getGuardApi($guard)->user();
    }

    public static function getUserApiId($guard = GUARD_ADMIN_API)
    {
        return self::getGuardApi($guard)->id();
    }

    public static function getGuardApi($guard = GUARD_ADMIN_API)
    {
        return Auth::guard($guard);
    }
}
