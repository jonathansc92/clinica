<?php

namespace App\Repositories;

use App\Models\Pacientes;

class PacientesRepository {

    public $model;

    public function __construct(Pacientes $model) {
        $this->model = $model;
    }

    public function gridLst() {
        return $this->model->select(
                                'tb_paciente.id', 'cpf', 'nome', 'd_nascimento', 'sexo', 'tb_plano.descricao as id_plano'
                        )
                        ->join('tb_plano', 'tb_plano.id', '=', 'tb_paciente.id_plano');
    }

}
