<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Category;
use App\Models\Countries;
use App\Models\Cities;
use App\Models\States;
use App\Models\Images;
use App\Models\PostsCategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use Toastr;

class PostsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    protected function getQuery()
    {
        return Posts::query();
    }

    function getPosts() {

       return Datatables::of($this->getQuery())
            ->addColumn('actions', function ($model) {
                return '
                        <a id="getModal" class="btn btn-info" 
                data-title="'.$model->title.'" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/admin/posts/show/' . $model->id . '"><i class="fa fa-eye"></i> Visualizar</a>
                <a class="btn btn-primary" href="/admin/posts/edit/'.$model->id.'"><i class="fa fa-edit"></i> Editar</a>
                <a class="btn btn-danger" href="/admin/posts/del/'.$model->id. '"><i class="fa fa-trash"></i> Deletar</a>';
            })
//            ->editColumn('data_criacao', function($rec){
//                return $rec->data_criacao ? with(new Carbon($rec->data_criacao))->format('d/m/Y h:i'): '';
//            })

            ->rawColumns(['actions'])->make(true);
    }

    function getTips() {
        return datatables(Posts::select('id', 'title', 'active', 'feature')->where('tip', 'S'))->toJson();
    }

    function index() {
        return view('admin.posts.table');
    }

    function add(Request $request) {

        $var['categoryLst'] = Category::select('id', 'description')->get();

        return view('admin.posts.add', compact('var'));
    }

    public function store(Request $request) {
        $data = $request->all();


        if (empty($data['content'])) {
            Toastr::error('Campo conteúdo não pode ser vazio', $title = null, $options = []);
            return redirect()->back();
        }

        if (empty($data['title'])) {
            Toastr::error('Campo Titulo não pode ser vazio', $title = null, $options = []);
            return redirect()->back();
        }

        $post = new Posts();

        $post->tip = $data['tip'];

        //Image
        $img = Input::file('imgdefault');
        if (request()->hasFile('imgdefault')) {

            $new_name = Images::newNameImage($img);

//             Upload Image
            Images::upload($new_name, $img, 669, 446, 'images/');

            $post->imgdefault = $new_name;
        }

        $post->title = $data['title'];
        $post->content = $data['content'];

        if (isset($data['data'])) {
            $data['data'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['data'])
                    ->format('Y-m-d');
            $post->data = $data['data'];
        }

        if (isset($data['countries_id'])) {
            $post->country_id = $data['countries_id'];
        }
        if (isset($data['state'])) {
            $post->state_id = $data['state'];
        }
        if (isset($data['city'])) {
            $post->city_id = $data['city'];
        }
        if (isset($data['active'])) {
            $post->active = 'S';
        } else {
            $post->active = 'N';
        }
        if (isset($data['feature'])) {
            $post->feature = 'S';
        } else {
            $data['feature'] = 'N';
            $post->feature = 'N';
        }
        $post->save();

        if (!empty($data['category'])) {
            for ($i = 0; $i < count($data['category']); $i++) {
                PostsCategory::trataSavePostsCategorias($data['category'][$i], $post->id);
            }
        }

        Toastr::success($post->title . ' Adicionado', $title = 'Post', $options = []);
        return redirect()->route('editpost', ['id' => $post->id]);
    }

    public function edit($id) {
        $var['post'] = Posts::findOrFail($id);
        $var['categoryLst'] = Category::select('id', 'description')->get();

        $pais = Countries::where('id', $var['post']->country_id)->get();

        $var['local'] = $pais[0]['namept'];

        return view('admin.posts.edit', compact('var'));
    }

    public function show($id) {
        $var['post'] = Posts::find($id);
        return view('admin.posts.show', compact('var'));
    }

    public function update(Request $request, $id) {

        $data = $request->all();

        $data['data'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['data'])
                ->format('Y-m-d');

        if (empty($data['content'])) {
            Toastr::error('Campo conteúdo não pode ser vazio', $title = null, $options = []);
            return redirect()->back();
        }

        if (empty($data['title'])) {
            Toastr::error('Campo Titulo não pode ser vazio', $title = null, $options = []);
            return redirect()->back();
        }

        $post = new Posts();
        $post->content = $data['content'];
        $post->title = $data['title'];
        $post->data = $data['data'];

//        if (isset($data['countries_id'])) {
//            $post->country_id = $data['countries_id'];
////            dd('entrou');
//        }
//        if (isset($data['state'])) {
//            $post->state_id = $data['state'];
//        }
//        if (isset($data['city'])) {
//            $post->city_id = $data['city'];
//        }
        if (isset($data['active'])) {
            $data['active'] = 'S';
            $post->active = $data['active'];
        } else {
            $data['active'] = 'N';
            $post->active = $data['active'];
        }
        if (isset($data['feature'])) {
            $data['feature'] = 'S';
            $post->feature = $data['feature'];
        } else {
            $data['feature'] = 'N';
            $post->feature = $data['feature'];
        }

        //Image
        $img = Input::file('imgdefault');
        if (request()->hasFile('imgdefault')) {

            $postimg = Posts::find($id);
            File::delete(public_path('images/' . $postimg->imgdefault));

            $new_name = Images::newNameImage($img);

//             Upload Image
            Images::upload($new_name, $img, 669, 446, 'images/');

            $data['imgdefault'] = $new_name;
            $post->imgdefault = $new_name;
        }

        if (!empty($data['category'])) {
            PostsCategory::deleteii($data['category'], $id);

            foreach ($data['category'] as $category) {

                PostsCategory::trataSavePostsCategorias($category, $id);
            }
        } else {
            PostsCategory::where('posts_id', $id)->delete();
        }

        $post->find($id)->update($data);
//        flash('Post ' . $post->title . ' atualizado')->success();
        Toastr::success($post->title . ' atualizado', $title = 'Post', $options = []);
        return redirect()->back();
    }

    public function destroy($id) {
        $post = Posts::find($id);

        PostsCategory::where('posts_id', $id)->delete();

        Posts::find($id)->delete();

        Toastr::success('Removido com sucesso.', $title = 'Post', $options = []);

        return redirect()->back();
    }

}
