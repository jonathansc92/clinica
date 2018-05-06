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
                data-title="Médico: ' . $model->nome . '" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/medicos/show/' . $model->id . '"><i class="fa fa-eye"></i> Ver</button>
                
                <a class="btn btn-primary" href="/medicos/edit/' . $model->id . '"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" href="/medicos/delete/' . $model->id . '"><i class="fa fa-trash"></i> </a>';
                        })
                        ->rawColumns(['actions'])->make(true);
    }

    public function index() {
        $displayName = 'Médicos';
        return view('medicos.index', compact('displayName', $displayName));
    }

    public function add() {

        $especialidades = \App\Models\Especialidades::pluck('descricao', 'id');

        return view('medicos.add')->with('especialidades', $especialidades);
    }

    public function store(Request $request) {

        $this->model->nome = $request['nome'];
        $this->model->cpf = $request['cpf'];
        $this->model->crm = $request['crm'];
        $this->model->d_nascimento = \Carbon\Carbon::parse($request['d_nascimento'])->format('Y-m-d');
        $this->model->sexo = $request['sexo'];
        $this->model->id_especialidade = $request['id_especialidade'];
        $this->model->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        $this->model->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $data = $this->model->save();

        Toastr::success('Salvo com sucesso', $title = 'Médico', $options = []);
        return redirect('/medicos/edit/' . $data->id);
    }

    public function edit($id) {
        $data = $this->model->find($id);
        $especialidades = \App\Models\Especialidades::pluck('descricao', 'id');

        return view('medicos.edit', compact('data', $data, 'especialidades', $especialidades));
    }

    public function show($id) {
        $data = $this->model->find($id);
        return view('medicos.show', compact('data', $data));
    }

    public function update(Request $request, $id) {

        $request['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $request['d_nascimento'] = \Carbon\Carbon::parse($request['d_nascimento'])->format('Y-m-d');

        $this->model->find($id)->update($request->all());

        Toastr::success('Atualizado com sucesso', $title = 'Médico', $options = []);
        
        return redirect()->back();
    }

    public function destroy($id) {
        $this->model->find($id)->delete();
        return redirect()->back();
    }

}
