<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Libs\Images;
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

    public function update(Request $request, $id) {

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

        dd(Input::file());

        $imgName = null;
        if (request()->hasFile('img')) {

            dd('entrou');

            $image = request()->file('img');


            $userImg = User::find($this->obj->getUserId());
            if (!empty($userImg->img)) {
                File::delete(public_path('images/perfil/' . $userImg->img));
            }
            $imgName = Images::newNameImage($image);

            dd($imgname);


//             Upload Image
            Images::upload($imgName, $image, 200, 200, 'images/perfil/');

            $data['img'] = $imgname;
        }

        $user->find($id)->update($data);

        Toastr::success('Atualizado com sucesso', $title = 'Perfil', $options = []);
        return redirect()->back();
    }

}
