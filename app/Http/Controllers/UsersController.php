<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Images;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {

        $var['title'] = 'Perfil';

        $var['user'] = User::first();

        return view('admin.aboutus.index', compact('var'));
    }

    public function update(Request $request)
    {

        $data = $request->all();

        $user = new User();

        $user->validation($data);

        if (!empty($data['password'])) {

            if ($user->first()->password != $data['password']) {
                if ($data['password'] == $data['confirm_password']) {
                    $data['password'] = bcrypt($data['password']);
                } else {
                    flash('As senhas preenchidas não são diferentes!')->error();
                    return redirect()->back();
                }
            }
        }


        if (isset($data['img'])) {
            $imgname = null;
            $img = Input::file('img');
            if (request()->hasFile('img')) {

                $userImg = User::first();
                if (!empty($userImg->img)) {
                    File::delete(public_path('images/perfil/' . $userImg->img));
                }
                $imgname = Images::newNameImage($img);

//             Upload Image
                Images::upload($imgname, $img, 200, 200, 'images/perfil/');

                $data['img'] = $imgname;

            }
        }

       $user->first()->update($data);

        flash('Perfil atualizado!')->success();

        return redirect()->back();
    }

}
