<?php

namespace App\Libs;

use Intervention\Image\ImageManagerStatic as Image;

class Images {

    public static function upload($nameimg, $input, $width, $height, $path) {

        $imgresize = Image::make($input->getRealPath());
        $imgresize->resize($width, $height);
        $imgresize->save(public_path($path . $nameimg));

    }

    public static function newNameImage($pName) {
        dd($pName);
        return md5($pName->getClientOriginalName() . time()) . '.' . $pName->getClientOriginalExtension();
    }

}
