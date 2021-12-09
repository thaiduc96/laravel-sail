<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    const timeFormat   = 'Y-m-d H:i:s';
    const dateFormat = 'Y-m-d';
    const isoFormat  = 'Y-m-d\TH:i:s\Z';
    const dbTz       = 'UTC';
    const date = 'd/m/Y';

    public static function formatDate($value, $format = self::date){
        if (empty($value)){
            return '';
        }
        return date($format, strtotime($value));
    }

    public static function addMonthToDate($month, $date){
        return date('Y-m-d', strtotime("+" . $month . " months", strtotime($date)));
    }


    public static function dbNow($toFormat = false)
    {
        if (!$toFormat) {
            $toFormat = self::dbFormat;
        }
        return Carbon::now()->format($toFormat);
    }

    public static function changeFormat($date, $fromFormat, $toFormat)
    {
        return Carbon::createFromFormat($fromFormat, $date)->format($toFormat);
    }

    public static function convertToObject($date, $tz = 'UTC')
    {
        return $date ? Carbon::parse($date)->setTimezone($tz)->toDateTimeImmutable() : null;
    }

    public static function parseDate($str, string $toFormat = '', $tz = 'UTC')
    {
        if (!$toFormat) {
            $toFormat = self::dbFormat;
        }
        if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $str)) {
            return self::changeFormat($str, 'Y-m-d', $toFormat);
        }
        if (preg_match("/^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}$/", $str)) {
            return self::changeFormat($str, 'Y-m-d H:i:s', $toFormat);
        }
        if (
            preg_match("/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.\d{3}Z$/", $str) ||
            preg_match("/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/", $str)
        ) {
            return Carbon::parse($str)->format($toFormat);
        }
        if (preg_match("/^\d{10}$/", $str)) {
            return Carbon::createFromTimestamp($str)->format($toFormat);
        }
        if (preg_match("/^\d{13}$/", $str)) {
            return Carbon::createFromTimestamp($str / 1000)->format($toFormat);
        }

        return $str;
    }

    public static function detectUserTz($time)
    {
        // $date = preg_replace("/\sGMT[+-]\d+\d+\s\([\w\s]+\)/", '', $time);
        $ar = preg_split("/(GMT[+-]\d+|UTC)/", $time);
        foreach ($ar as $i) {
            $time = str_replace($i, '', $time);
        }

        return $time;
    }
}
