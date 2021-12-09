<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHelper
{
    public static function getFileNameFromPath($path)
    {
        if (empty($path)) {
            return null;
        }
        $file = pathinfo($path);
        return $file['basename'];
    }

    public static function createImageThumbnail($path,$storePath, $width = 100, $height = 100)
    {
        $fileName = self::getFileNameFromPath($path);

        if (!Storage::exists($path)) {
            return null;
        }

        $file_data = file_get_contents(Storage::url($path), false, stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]));

        $photo = Image::make($file_data)
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg', 95);

        $thumbnailPath = $width . 'x' . $height . '_' . $fileName;
        $thumbnailPath = implode('/',[$storePath,$thumbnailPath]);
        Storage::put($thumbnailPath, $photo);
        return $thumbnailPath;
    }
}
