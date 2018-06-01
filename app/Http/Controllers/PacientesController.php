<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Pacientes;
use Toastr;

class PacientesController extends Controller {

    protected $obj;

    public function __construct(Pacientes $obj) {
        $this->middleware('auth');
        $this->obj = $obj;
    }

    function data() {

        $builder = $this->obj->gridLst();

        return Datatables::of($builder)
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
                        ->setTotalRecords($builder->count())
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
        $data = $this->obj->saveOrUpdate($request->all());

        Toastr::success('Salvo com sucesso', $title = 'Paciente', $options = []);
        return redirect('/pacientes/edit/' . $data);
    }

    public function edit($id) {
        $data = $this->obj->find($id);
        $planos = \App\Models\Planos::pluck('descricao', 'id');

        return view('pacientes.edit', compact('data', $data, 'planos', $planos));
    }

    public function show($id) {
        $pacientes = $this->obj->with('plano')->find($id);

        return view('pacientes.show', compact('pacientes', $pacientes));
    }

    public function update(Request $request, $id) {
        
        $this->obj->saveOrUpdate($request->all(), $id);
        Toastr::success('Salvo com sucesso', $title = 'Paciente', $options = []);

        return redirect()->back();
    }

    public function destroy($id) {
        try {
            $this->obj->find($id)->delete();
            Toastr::success('Removido com sucesso', $title = 'Paciente', $options = []);
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error('Não é possível remover. Este dado está sendo usado.', $title = 'Paciente', $options = []);
        }

        return redirect()->back();
    }

}
