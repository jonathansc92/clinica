<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    function index() {
        $var['dataLst'] = json_encode(Category::select('id', 'description')->get());

        return view('admin.category.index', compact('var'));
    }

    public function store(Request $request) {
        $data = $request->all();

        $validation = \Validator::make($data, [
                    'description' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        $cat = new Category();
        $cat->description = $data['description'];
        $cat->save();

        Session::flash("store", $data['description']);

        return redirect()->back();
    }

    public function update(Request $request, $id) {

   $data = $request->all();

        $validation = \Validator::make($data, [
                    'description' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        $cat = new Category();
        $cat->description = $data['description'];
//        dd($nameimg);
        $cat->find($id)->update($data);

        Session::flash("update", $data['description']);

        return redirect()->back();
    }

    public function destroy($id) {
        $cat = Category::find($id);
        Category::find($id)->delete();

        Session::flash("del", $cat['description']);

        return redirect()->back();
    }

}
