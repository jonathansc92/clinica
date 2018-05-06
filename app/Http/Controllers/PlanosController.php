<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use App\Models\Planos;
use Toastr;

class PlanosController extends Controller {

    public function __construct(Planos $plano) {
        $this->middleware('auth');
        $this->model = $plano;
    }

    protected function getQuery() {
        return $this->model->query();
    }

    function data() {

        return Datatables::of($this->getQuery())
                        ->addColumn('actions', function ($model) {
                            return '
                        <button id="getModal" class="btn btn-info" 
                data-title="Plano: ' . $model->descricao . '" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/planos/show/' . $model->id . '"><i class="fa fa-eye"></i> Ver</button>
                
                <button id="getModal" class="btn btn-primary" 
                data-title="Editar" 
                data-toggle="modal" 
                data-target=".modal" 
                data-url="/planos/edit/' . $model->id . '"><i class="fa fa-edit"></i> </button>
                <a class="btn btn-danger" href="/planos/delete/' . $model->id . '"><i class="fa fa-trash"></i> </a>';
                        })
//            ->editColumn('data_criacao', function($rec){
//                return $rec->data_criacao ? with(new Carbon($rec->data_criacao))->format('d/m/Y h:i'): '';
//            })
                        ->rawColumns(['actions'])->make(true);
    }

    public function index() {
        $displayName = 'Planos';
        return view('planos.index', compact('displayName', $displayName));
    }

    public function add() {

        return view('planos.add');
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
        $planos = $this->model->find($id);

        return view('planos.edit', compact('planos', $planos));
    }

    public function show($id) {
        $planos = $this->model->find($id);
        return view('planos.show', compact('planos', $planos));
    }

    public function update(Request $request, $id) {

        $request['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();

        $this->model->find($id)->update($request->all());

        return response()->json(['status' => 200, 'title' => 'Plano', 'msg' => 'Atualizado com sucesso']);
    }

    public function destroy($id) {
        try {
            $this->model->find($id)->delete();
            Toastr::success('Removido com sucesso', $title = 'Plano', $options = []);
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error('Não é possível remover. Este dado está sendo usado.', $title = 'Plano', $options = []);
        }
        return redirect()->back();
    }

}
