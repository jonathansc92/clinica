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
use App\Http\Reports\AgendamentosReports;

class AgendamentosController extends Controller {

    protected $model;
    protected $medicosLst;
    protected $pacientesLst;
    protected $data_inicial;
    protected $data_final;
    protected $reports;

    public function __construct(Agendamentos $obj, Pacientes $pacientes, Medicos $medicos) {
        $this->middleware('auth');

        $this->model = $obj;
        $this->medicosLst = $medicos->pluck('nome', 'id');
        $this->pacientesLst = $pacientes->pluck('nome', 'id');

        $this->reports = new AgendamentosReports($this->model);
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

        Toastr::success('Salvo com sucesso', $title = 'Agendamento', $options = []);
        return redirect('/agendamentos/edit/' . $agendamento);
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
        $agendamentos = $this->model->with(['paciente', 'medico'])->find($id);

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

        return $this->reports->geraRelatorio($request->data_inicial,$request->data_final);
        
    }

    public function download(Request $request) {

        return $this->reports->doPdf($request->data_inicial,$request->data_final);
    }

}
