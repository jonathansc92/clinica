<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Agendamentos;
use App\Models\Pacientes;
use App\Models\Medicos;
use App\Libs\Date;
use Toastr;
use App\Constants\Status;

class AgendamentosController extends Controller {

    protected $model;
    protected $medicosLst;
    protected $pacientesLst;

    public function __construct(Agendamentos $obj, Pacientes $pacientes, Medicos $medicos) {
        $this->middleware('auth');
        $this->model = $obj;
        $this->medicosLst = $medicos->pluck('nome', 'id');
        $this->pacientesLst = $pacientes->pluck('nome', 'id');
    }
    
    public function data() {

        $builder = $this->model->gridLst();

        return Datatables::of($builder)
                        ->editColumn('data_hora', function($rec) {
                            return Date::dateTimeBR($rec->data_hora);
                        })
                        ->editColumn('status', function($rec) {
                            return Status::getStatusWithStyle($rec->status);
                        })
                        
                        ->addColumn('actions', function ($model) {
                            return '
                        <button id="getModal" class="btn btn-info" 
                data-title="Agendamento" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/agendamentos/show/' . $model->id . '"><i class="fa fa-eye"></i></button>
                
                <a class="btn btn-primary" href="/agendamentos/edit/' . $model->id . '"><i class="fa fa-edit"></i> </a>';
                        })
                        ->setTotalRecords($builder->count())
                        ->rawColumns(['actions', 'status'])->make(true);
    }

    public function index() {
        $displayName = 'Agendamentos';
        return view('agendamentos.index', compact('displayName', $displayName));
    }

    public function add() {

        $pacientes = $this->pacientesLst;
        $medicos = $this->medicosLst;
        return view('agendamentos.add')
                        ->with('pacientes', $pacientes)
                        ->with('medicos', $medicos);
    }

    public function store(Request $request) {
        
        $agendamento = $this->model->saveOrUpdate($request->all());
        
        dd($agendamento);

        Toastr::success('Salvo com sucesso', $title = 'Agendamento', $options = []);
        return redirect('/agendamentos/edit/' . $especialidade->id);
    }

    public function edit($id) {
        $agendamentos = $this->model->find($id);

        $pacientes = $this->pacientesLst;
        $medicos = $this->medicosLst;

        return view('agendamentos.edit', compact('agendamentos', $agendamentos))
                        ->with('pacientes', $pacientes)
                        ->with('medicos', $medicos);
    }

    public function show($id) {
        $agendamentos = $this->model->with(['paciente','medico'])->find($id);
                
        return view('agendamentos.show', compact('agendamentos', $agendamentos));
    }

    public function update(Request $request, $id) {

        $this->model->saveOrUpdate($request->all(), $id);

        Toastr::success('Salvo com sucesso', $title = 'Agendamento', $options = []);
        
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

    public function relatorio() {
        $pacientes = \App\Models\Pacientes::pluck('nome', 'id');
        return view('relatorios.relatorio-agendamentosForm')->with('pacientes', $pacientes);
    }

    public function emitirRelatorio(Request $request) {

        $data_inicial = Date::convertBRToUSA($request->data_inicial);
        $data_final = Date::convertBRToUSA($request->data_final);
        
        $data = $this->model->with(['medico', 'paciente'])
                ->whereBetween('data', [$data_inicial, $data_final])
                ->orderBy('data', 'desc')
                ->get();

        return view('relatorios.relatorio-agendamentos')->with('data', $data);
    }

}
