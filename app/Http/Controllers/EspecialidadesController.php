<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Especialidades;
use Toastr;

class EspecialidadesController extends Controller {
    
    protected $model;

    public function __construct(Especialidades $obj) {
        $this->middleware('auth');
        $this->model = $obj;
    }

    protected function getQuery() {
        return $this->model->query();
    }

    function data() {

        $builder = $this->getQuery();
        $builder->select('id', 'descricao', 'valor_consulta')->OrderBy('descricao', 'ASC');
        
        return Datatables::of($builder)
                        ->editColumn('valor_consulta', function($rec) {
                            return number_format($rec->valor_consulta, 2, ',', '.');
                        })
                        ->addColumn('actions', function ($model) {
                            return '
                        <button id="getModal" class="btn btn-info" 
                data-title="Especialidade" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/especialidades/show/' . $model->id . '"><i class="fa fa-eye"></i></button>
                
                <a class="btn btn-primary" href="/especialidades/edit/' . $model->id . '"><i class="fa fa-edit"></i> </a>
                 <a class="btn btn-danger" href="/especialidades/delete/' . $model->id . '"><i class="fa fa-trash"></i> </a>';
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

       $data = $this->model->saveOrUpdate($request->all(), null);

        Toastr::success('Salvo com sucesso', $title = 'Especialidade', $options = []);
        return redirect('/especialidades/edit/' . $data);
    }

    public function edit($id) {
        $especialidades = $this->model->find($id);

        return view('especialidades.edit', compact('especialidades', $especialidades));
    }

    public function show($id) {
        $especialidade = $this->model->find($id);
        return view('especialidades.show', compact('especialidade', $especialidade));
    }

    public function update(Request $request, $id) {

        $data = $this->model->saveOrUpdate($request->all(), $id);

        Toastr::success('Salvo com sucesso', $title = 'Especialidade', $options = []);
        return redirect()->back();
    }

    public function destroy($id) {
        try {
            $this->model->find($id)->delete();
            Toastr::success('Removido com sucesso', $title = 'Especialidade', $options = []);
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error('Não é possível remover. Este dado está sendo usado.', $title = 'Especialidade', $options = []);
        }
        return redirect()->back();
    }

}
