<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function ImageUpload(string $dir, $image = null)
    {
        if ($image != null) {
            $imageName = Carbon::now()->toDateString() . "-" . Str::random(15). "." . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $imageName, file_get_contents($image));

        } else {
            $imageName = 'def.png';
        }

        return $imageName;
    }

    public static function UpperCase(string $string = ''){
        return Str::upper($string) ;
    }
}

