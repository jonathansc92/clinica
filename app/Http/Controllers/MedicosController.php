<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Medicos;
use Toastr;
use Illuminate\Support\Facades\Log;

class MedicosController extends Controller {

    protected $obj;

    public function __construct(Medicos $obj) {
        $this->middleware('auth');
        $this->obj = $obj;
    }

    public function data() {
        $builder = $this->obj->gridLst();

        return Datatables::of($builder)
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
                data-url="/medicos/show/' . $model->id . '"><i class="fa fa-eye"></i></button>
                
                <a class="btn btn-primary" href="/medicos/edit/' . $model->id . '"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" href="/medicos/delete/' . $model->id . '"><i class="fa fa-trash"></i> </a>';
                        })
                        ->rawColumns(['actions'])->make(true);
    }

    public function index() {
        $displayName = 'Médicos';
//       $log = Log::alert('just test');
//       dd($log);
        return view('medicos.index', compact('displayName', $displayName));
    }

    public function add() {

        $especialidades = \App\Models\Especialidades::pluck('descricao', 'id');

        return view('medicos.add')->with('especialidades', $especialidades);
    }

    public function store(Request $request) {

        $data = $this->obj->saveOrUpdate($request->all());

        if(is_numeric($data)) {
            Toastr::success('Salvo com sucesso', $title = 'Médico', $options = []);
            return redirect('/pacientes/edit/' . $data);
        }
        else {
            Toastr::warning($data, $title = 'Médico', $options = []);
            return redirect()->back();
        }

    }

    public function edit($id) {
        $data = $this->obj->find($id);
        $especialidades = \App\Models\Especialidades::pluck('descricao', 'id');

        return view('medicos.edit', compact('data', $data, 'especialidades', $especialidades));
    }

    public function show($id) {
        $data = $this->obj->find($id);
        return view('medicos.show', compact('data', $data));
    }

    public function update(Request $request, $id) {

        $medico = $this->obj->saveOrUpdate($request->all(), $id);


        if(is_numeric($medico))
            Toastr::success('Salvo com sucesso', $title = 'Médico', $options = []);
        else
            Toastr::warning($medico, $title = 'Médico', $options = []);

        return redirect()->back();
    }

    public function destroy($id) {
        try {
            $this->obj->find($id)->delete();
            Toastr::success('Removido com sucesso', $title = 'Médico', $options = []);
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error('Não é possível remover. Este dado está sendo usado.', $title = 'Médico', $options = []);
        }
        return redirect()->back();
    }

}
