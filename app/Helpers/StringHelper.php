<?php


namespace App\Helpers;


class StringHelper
{
    public static function toNumber($dest)
    {
        if ($dest)
            return ord(strtolower($dest)) - 96;
        else
            return 0;
    }
}
