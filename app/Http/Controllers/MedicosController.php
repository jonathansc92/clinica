<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use App\Models\Medicos;
use Toastr;

class MedicosController extends Controller {

    public function __construct(Medicos $obj) {
        $this->middleware('auth');
        $this->model = $obj;
    }

    protected function getQuery() {
        return $this->model->query();
    }

    function data() {

        return Datatables::of($this->model->gridLst())
                        ->editColumn('d_nascimento', function($rec) {
                            return \Carbon\Carbon::parse($rec->d_nascimento)->format('d/m/Y');
                        })
                        ->addColumn('actions', function ($model) {
                            return '
                        <button id="getModal" class="btn btn-info" 
                data-title="Plano: ' . $model->descricao . '" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/medicos/show/' . $model->id . '"><i class="fa fa-eye"></i> Visualizar</button>
                
                <button id="getModal" class="btn btn-primary" 
                data-title="Editar" 
                data-toggle="modal" 
                data-target=".modal" 
                data-url="/medicos/edit/' . $model->id . '"><i class="fa fa-edit"></i> Editar</button>
                <a class="btn btn-danger" href="/medicos/delete/' . $model->id . '"><i class="fa fa-trash"></i> Deletar</a>';
                        })
                        ->rawColumns(['actions'])->make(true);
    }

    public function index() {
        $displayName = 'Médicos';
        return view('medicos.index', compact('displayName', $displayName));
    }

    public function add() {

        return view('medicos.add');
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
        $medicos = $this->model->find($id);

        return view('medicos.edit', compact('medicos', $medicos));
    }

    public function show($id) {
        $medicos = $this->model->find($id);
        return view('medicos.show', compact('medicos', $medicos));
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
