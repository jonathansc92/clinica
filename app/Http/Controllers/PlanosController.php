<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Planos;
use Toastr;

class PlanosController extends Controller {
    
    protected $model;

    public function __construct(Planos $plano) {
        $this->middleware('auth');
        $this->model = $plano;
    }

    protected function getQuery() {
        return $this->model->query();
    }

    function data() {

        $builder = $this->getQuery();
        $builder->select(
                'id',
                'descricao',
                'cnpj',
                'contato')->OrderBy('descricao', 'ASC');
        return Datatables::of($builder)
                        ->addColumn('actions', function ($model) {
                            return '
                        <button id="getModal" class="btn btn-info" 
                data-title="Plano: ' . $model->descricao . '" 
                data-toggle="modal" 
                data-type="view" 
                data-target=".modal" 
                data-url="/planos/show/' . $model->id . '"><i class="fa fa-eye"></i></button>
                
                <a class="btn btn-primary"  href="/planos/edit/' . $model->id . '"><i class="fa fa-edit"></i> </a>
                <a class="btn btn-danger" href="/planos/delete/' . $model->id . '"><i class="fa fa-trash"></i> </a>';
                        })
                        ->setTotalRecords($builder->count())
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
        
       $planos = $this->model->saveOrUpdate($request->all(), null);

        if(is_numeric($planos)) {
            Toastr::success('Salvo com sucesso', $title = 'Plano', $options = []);
            return redirect('/planos/edit/' . $planos);
        }
        else {
            Toastr::warning($planos, $title = 'Plano', $options = []);
            return redirect()->back();
        }

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

        $planos = $this->model->saveOrUpdate($request->all(), $id);

        Toastr::success('Salvo com sucesso', $title = 'Plano', $options = []);

        if(is_numeric($planos)) {
            Toastr::success('Salvo com sucesso', $title = 'Plano', $options = []);
        }
        else {
            Toastr::warning($planos, $title = 'Plano', $options = []);
        }

        return redirect()->back();
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
