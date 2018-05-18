<?php

namespace App\Services;

use App\Repositories\PacientesRepository;

class PacientesService extends CrudService {

    protected $repository;

    public function __construct(PacientesRepository $repository) {
        $this->repository = $repository;
    }

    public function saveOrUpdate($pData, $pId = null) {
        
        dd($pData);

        $pData['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $pData['d_nascimento'] = \Carbon\Carbon::parse($pData['d_nascimento'])->format('Y-m-d');


        if ($pId != null) {
            $this->repository->model->find($pId)->update([$pData]);
        } else {
            $pData['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $this->repository->model->create([$pData]);
        }
    }

}
