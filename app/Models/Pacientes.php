<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model {

    protected $fillable = [
        'id',
        'cpf',
        'nome',
        'd_nascimento',
        'sexo',
        'id_plano',
        'created_at',
        'updated_at'
    ];
    protected $table = 'tb_paciente';
    protected $primaryKey = 'id';

    public function __construct() {
        
    }

    public function rules() {
        return [
            'cpf' => 'required|',
            'nome' => 'required',
            'd_nascimento' => 'required',
            'sexo' => 'required',
            'plano' => 'required'
        ];
    }

    public function plano() {
        return $this->belongsTo(\App\Models\Planos::class, 'id_plano');
    }

    public function gridLst() {
        return $this->join('tb_plano', 'tb_plano.id', '=', 'tb_paciente.id_plano')
                        ->select('tb_paciente.id', 'tb_paciente.sexo', 'tb_paciente.cpf', 'tb_paciente.nome', 'tb_paciente.d_nascimento', 'tb_plano.descricao as plano');
    }

}
