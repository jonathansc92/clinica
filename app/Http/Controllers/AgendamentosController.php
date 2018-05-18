<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Agendamentos;
use Toastr;

class AgendamentosController extends Controller {

    public function __construct(Agendamentos $obj) {
        $this->middleware('auth');
        $this->model = $obj;
    }

    protected function getQuery() {
        return $this->model->query();
    }

    function data() {

        $builder = $this->getQuery();
        $builder->select(
                        'tb_agendamento.id', 'data_hora', 'tb_paciente.nome as id_paciente', 'tb_cadastro_medico.nome as id_medico'
                )
                ->join('tb_paciente', 'tb_paciente.id', '=', 'tb_agendamento.id_paciente')
                ->join('tb_cadastro_medico', 'tb_cadastro_medico.id', '=', 'tb_agendamento.id_medico');

        return Datatables::of($builder)
                        ->editColumn('data_hora', function($rec) {
                            return \Carbon\Carbon::parse($rec->data_hora)->format('d/m/Y h:i');
                        })
                        ->addColumn('actions', function ($model) {
                            return '
                        <button id="getModal" class="btn btn-info" 
                data-title="Especialidade" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/agendamentos/show/' . $model->id . '"><i class="fa fa-eye"></i></button>
                
                <a class="btn btn-primary" href="/agendamentos/edit/' . $model->id . '"><i class="fa fa-edit"></i> </a>
                 <a class="btn btn-danger" href="/agendamentos/delete/' . $model->id . '"><i class="fa fa-trash"></i> </a>';
                        })
                        ->setTotalRecords($builder->count())
                        ->rawColumns(['actions'])->make(true);
    }

    public function index() {
        $displayName = 'Agendamentos';
        return view('agendamentos.index', compact('displayName', $displayName));
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
        $especialidade = $this->model->find($id);
        return view('especialidades.show', compact('especialidade', $especialidade));
    }

    public function update(Request $request, $id) {

        $request['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();

        $this->model->find($id)->update($request->all());

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

    public function relatorio() {
        return view('relatorios.relatorio-agendamentosForm');
    }

    public function emitirRelatorio(Request $request) {

        $data_inicial = \Carbon\Carbon::createFromFormat('d/m/Y', $request->data_inicial)->format('Y-m-d');
        $data_final = \Carbon\Carbon::createFromFormat('d/m/Y', $request->data_final)->format('Y-m-d');

        $data = $this->model->with(['medico', 'paciente'])
                ->whereBetween('data_hora', [$data_inicial, $data_final])
                ->orderBy('data_hora', 'desc')
                ->get();

        return view('relatorios.relatorio-agendamentos')->with('data', $data);
    }

}
