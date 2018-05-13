<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Pacientes;
use Toastr;

class PacientesController extends Controller {

    public function __construct(Pacientes $obj) {
        $this->middleware('auth');
        $this->model = $obj;
    }

    protected function getQuery() {
        return $this->model->query();
    }

    function data() {

        $builder = $this->getQuery();
        $builder->with('plano');
        
        return Datatables::of($this->getQuery())
                        ->editColumn('descPlano', function($rec) {
                            return $rec->plano->descricao;
                        })
                        ->editColumn('d_nascimento', function($rec) {
                            return \Carbon\Carbon::parse($rec->d_nascimento)->format('d/m/Y');
                        })
                        ->addColumn('actions', function ($model) {
                            return '
                        <button id="getModal" class="btn btn-info" 
                data-title="Paciente" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/pacientes/show/' . $model->id . '"><i class="fa fa-eye"></i> </button>
                
             <a class="btn btn-primary" href="/pacientes/edit/' . $model->id . '"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" href="/pacientes/delete/' . $model->id . '"><i class="fa fa-trash"></i> </a>';
                        })
                        ->rawColumns(['actions'])->make(true);
    }

    public function index() {
        $displayName = 'Pacientes';
        return view('pacientes.index', compact('displayName', $displayName));
    }

    public function add() {
        $planos = \App\Models\Planos::pluck('descricao', 'id');

        return view('pacientes.add')
                        ->with('planos', $planos);
    }

    public function store(Request $request) {
        $this->model->nome = $request['nome'];
        $this->model->cpf = $request['cpf'];
        $this->model->d_nascimento = \Carbon\Carbon::parse($request['d_nascimento'])->format('Y-m-d');
        $this->model->sexo = $request['sexo'];
        $this->model->id_plano = $request['id_plano'];
        $this->model->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        $this->model->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $data = $this->model->save();

        Toastr::success('Salvo com sucesso', $title = 'Paciente', $options = []);
        return redirect('/pacientes/edit/' . $data->id);
    }

    public function edit($id) {
        $data = $this->model->find($id);
        $planos = \App\Models\Planos::pluck('descricao', 'id');

        return view('pacientes.edit', compact('data', $data, 'planos', $planos));
    }

    public function show($id) {
        $pacientes = $this->model->with('plano')->find($id);
        
        return view('pacientes.show', compact('pacientes', $pacientes));
    }

    public function update(Request $request, $id) {

        $request['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $request['d_nascimento'] = \Carbon\Carbon::parse($request['d_nascimento'])->format('Y-m-d');

        $this->model->find($id)->update($request->all());

        Toastr::success('Salvo com sucesso', $title = 'Paciente', $options = []);

        return redirect()->back();
    }

    public function destroy($id) {
        try {
            $this->model->find($id)->delete();
            Toastr::success('Removido com sucesso', $title = 'Paciente', $options = []);
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error('Não é possível remover. Este dado está sendo usado.', $title = 'Paciente', $options = []);
        }

        return redirect()->back();
    }

}
