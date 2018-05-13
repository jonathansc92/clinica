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
                
                <a class="btn btn-primary" href="/especialidades/edit/' . $model->id . '"><i class="fa fa-edit"></i> Editar</a>
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

        $this->model->descricao = $request['descricao'];
        $this->model->valor_consulta = $request['valor_consulta'];
        $this->model->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        $this->model->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $especialidade = $this->model->save();

        Toastr::success('Salvo com sucesso', $title = 'Especialidade', $options = []);
        return redirect('/especialidades/edit/' . $especialidade->id);
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

        Toastr::success('Salvo com sucesso', $title = 'Especialidade', $options = []);
        return redirect()->back();
    }

    public function destroy($id) {
        $this->model->find($id)->delete();
        Toastr::success('Apagado com sucesso', $title = 'Especialidade', $options = []);
        return redirect()->back();
    }

}
