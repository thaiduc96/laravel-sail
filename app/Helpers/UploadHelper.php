<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadHelper
{
    public static function uploadFromRequest($requestName, $path = '')
    {
        $files = request()->file($requestName);
        if (!$files) {
            return request()->get($requestName) ?? false;
        }

        if (!$path) {
            $path = 'upload_' . date('Ymd');
        }

        if (!is_array($files)) {
            return self::uploadSingle($files, $path);
        }

        $names = [];
        foreach ($files as $file) {
            $names[] = self::uploadSingle($file, $path);
        }

        return $names;
    }

    public static function uploadSingle($file, $path, $name = null)
    {
        $fileName =!empty($name) ? $name : self::generateFileName($file->getClientOriginalName());
        $path = Storage::putFileAs(
            $path,
            $file,
            $fileName,
            'public'
        );

        $path = str_replace('//', '/', $path);

        return $path;
    }

    public static function generateFileName($filename)
    {
        $arr = explode('.', $filename);
        $ext = array_pop($arr);

        $ran = Str::random(5);
        $nam =  date('Ymd-His') . '-'. $ran ;
        $nam = preg_replace("/[^a-zA-Z0-9]+/", "-", $nam);

        return "$nam.$ext";
    }

    public static function delete($path = null)
    {
        if (is_null($path)) {
            return;
        }

        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    public static function retrieveFilePath($file)
    {
        return public_path("storage/$file");
    }
}
