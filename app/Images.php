<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model {

    public static function fileUpload($file) {
//        $this->validate(request(), [
//            'title' => 'required',
//            'slug' => 'required',
//            'file' => 'required|image|mimes:jpg,jpeg,png,gif'
//        ]);

        $fileName = null;
        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads/categories/', $fileName);
        }
        dd($fileName);

        $request->user_photo->move(public_path('avatars'), $photoName);

        dd($fileName);
    }

}
