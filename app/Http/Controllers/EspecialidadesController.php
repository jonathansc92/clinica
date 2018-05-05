<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use App\Models\Especialidades;
use Toastr;

class EspecialidadesController extends Controller {

    public function __construct(Especialidades $obj) {
        $this->middleware('auth');
        $this->model = $obj;
    }

    protected function getQuery() {
        return $this->model->query();
    }

    function data() {

        return Datatables::of($this->getQuery())
//                        ->editColumn('d_nascimento', function($rec) {
//                            return \Carbon\Carbon::parse($rec->d_nascimento)->format('d/m/Y');
//                        })
                        ->addColumn('actions', function ($model) {
                            return '
                        <button id="getModal" class="btn btn-info" 
                data-title="Plano: ' . $model->descricao . '" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/especialidades/show/' . $model->id . '"><i class="fa fa-eye"></i> Visualizar</button>
                
                <button id="getModal" class="btn btn-primary" 
                data-title="Editar" 
                data-toggle="modal" 
                data-target=".modal" 
                data-url="/especialidades/edit/' . $model->id . '"><i class="fa fa-edit"></i> Editar</button>
                <a class="btn btn-danger" href="/especialidades/delete/' . $model->id . '"><i class="fa fa-trash"></i> Deletar</a>';
                        })
                        ->rawColumns(['actions'])->make(true);
    }

    public function index() {
        $displayName = 'Especialidades';
        return view('especialidades.index', compact('displayName', $displayName));
    }

    public function add() {

        return view('especialidades.add');
    }

    public function store(Request $request) {
        //        if (empty($data['content'])) {
//            Toastr::error('Campo conteúdo não pode ser vazio', $title = null, $options = []);
//            return redirect()->back();
//        }
//
//        if (empty($data['title'])) {
//            Toastr::error('Campo Titulo não pode ser vazio', $title = null, $options = []);
//            return redirect()->back();
//        }

        $this->model->descricao = $request['descricao'];
        $this->model->cnpj = $request['cnpj'];
        $this->model->contato = $request['contato'];
        $this->model->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        $this->model->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $this->model->save();

        return response()->json(['status' => 200, 'title' => 'Plano', 'msg' => 'Salvo com sucesso']);
    }

    public function edit($id) {
        $especialidades = $this->model->find($id);

        return view('especialidades.edit', compact('especialidades', $especialidades));
    }

    public function show($id) {
        $especialidades = $this->model->find($id);
        return view('especialidades.show', compact('especialidades', $especialidades));
    }

    public function update(Request $request, $id) {

        $request['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();

        $this->model->find($id)->update($request->all());

        return response()->json(['status' => 200, 'title' => 'Plano', 'msg' => 'Atualizado com sucesso']);
    }

    public function destroy($id) {
        $this->model->find($id)->delete();
        return redirect()->back();
    }

}
