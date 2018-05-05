<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use App\Models\Planos;
use Toastr;

class PlanosController extends Controller {

    public function __construct() {
      //  $this->middleware('auth');
    }

    protected function getQuery() {
        return Planos::query();
    }

    function getPlanos() {

        return Datatables::of($this->getQuery())
                        ->addColumn('actions', function ($model) {
                            return '
                        <a id="getModal" class="btn btn-info" 
                data-title="' . $model->title . '" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/planos/show/' . $model->id . '"><i class="fa fa-eye"></i> Visualizar</a>
                <a class="btn btn-primary" href="/admin/posts/edit/' . $model->id . '"><i class="fa fa-edit"></i> Editar</a>
                <a class="btn btn-danger" href="/admin/posts/del/' . $model->id . '"><i class="fa fa-trash"></i> Deletar</a>';
                        })
//            ->editColumn('data_criacao', function($rec){
//                return $rec->data_criacao ? with(new Carbon($rec->data_criacao))->format('d/m/Y h:i'): '';
//            })
                        ->rawColumns(['actions'])->make(true);
    }

    public function index() {
        return view('planos.table');
    }

    public function add() {

        return view('planos.add');
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
        
        $this->save($data);
        return response()->json(['status' => 200, 'title' => 'Plano', 'msg' => 'Salvo com sucesso']);
    }

    public function edit($id) {
        $var['post'] = Posts::findOrFail($id);

        return view('admin.posts.edit', compact('var'));
    }

    public function show($id) {
        $var['post'] = Posts::find($id);
        return view('admin.posts.show', compact('var'));
    }

    public function update(Request $request, $id) {

        $data = $request->all();

        $post = new Posts();
        $post->find($id)->update($data);
        return response()->json(['status' => 200, 'title' => 'Plano', 'msg' => 'Atualizado com sucesso']);

    }

    public function destroy($id) {
        $post = Posts::find($id);

        return response()->json(['status' => 200, 'title' => 'Plano', 'msg' => 'Deletado com sucesso']);
    }

}
