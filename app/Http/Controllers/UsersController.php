<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Images;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Toastr;

class UsersController extends Controller {

    public function __construct(User $obj) {
        $this->middleware('auth');
        $this->obj = $obj;
    }

    public function edit() {

        $var['title'] = 'Perfil';

        $var['user'] = User::find($this->obj->getUserId());

        return view('users.edit', compact('var'));
    }

    public function update(Request $request) {

        $data = $request->all();

        $user = new User();

        $user->validation($data);

        if (!empty($data['password'])) {

            if ($user->first()->password != $data['password']) {
                if ($data['password'] == $data['confirm_password']) {
                    $data['password'] = bcrypt($data['password']);
                } else {
                    Toastr::warning('As senhas preenchidas não são diferentes!', $title = 'Perfil', $options = []);
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

        Toastr::success('Atualizado com sucesso', $title = 'Perfil', $options = []);
        return redirect()->back();
    }

}
