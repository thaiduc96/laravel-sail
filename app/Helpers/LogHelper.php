<?php


namespace App\Helpers;


class LogHelper
{
    public static function loggingSms($result, $isFailed = false){
        if($isFailed){
            \Log::channel('smslog')->debug('Logging error: ' . json_encode($result));
        }else{
            \Log::channel('smslog')->debug('Logging information: ' . json_encode($result));
        }
    }

    public static function loggingSendEmail($result, $isFailed = false){
        if($isFailed){
            \Log::channel('emaillog')->debug('Logging error: ' . json_encode($result, JSON_UNESCAPED_UNICODE));
        }else{
            \Log::channel('emaillog')->info('Logging information: ' . json_encode($result, JSON_UNESCAPED_UNICODE));

        }
    }

    public static function loggingError($result){
        \Log::channel('apierrorlog')->debug('Logging information: ' . json_encode($result, JSON_UNESCAPED_UNICODE));
    }

    public static function loggingAwsError($result){
        \Log::channel('awslog')->debug('Logging information: ' . json_encode($result, JSON_UNESCAPED_UNICODE));
    }
}
