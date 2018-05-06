<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicos extends Model {

    protected $fillable = [
        'id',
        'crm',
        'cpf',
        'nome',
        'd_nascimento',
        'sexo',
        'id_especialidade',
        'created_at',
        'updated_at'
    ];
    protected $table = 'tb_cadastro_medico';
    protected $primaryKey = 'id';

    public function __construct() {
        
    }
    
    public function especialidade(){
        return $this->hasOne(\App\Models\Especialidades::class, 'id_especialidade');
    }

    public function gridLst() {
        return $this->join('tb_especialidade', 'tb_especialidade.id', '=', 'tb_cadastro_medico.id_especialidade')
                        ->select('tb_cadastro_medico.id','tb_cadastro_medico.crm', 'tb_cadastro_medico.cpf', 'tb_cadastro_medico.nome', 'tb_cadastro_medico.d_nascimento', 'tb_especialidade.descricao as especialidade');
    }

}
