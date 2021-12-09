<?php


namespace App\Helpers;


class CodeHelper
{
    public static function fullNumberWithLeadingZero($number,$length = 6)
    {
        $result = str_pad($number, $length, '0', STR_PAD_LEFT);
        return $result;
    }
}
