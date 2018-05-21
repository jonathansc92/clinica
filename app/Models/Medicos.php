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

    public function especialidade() {
        return $this->belongsTo(\App\Models\Especialidades::class, 'id_especialidade');
    }

    public function gridLst() {
        return $this->select(
                        'tb_cadastro_medico.id', 'tb_cadastro_medico.crm', 'tb_cadastro_medico.cpf', 'tb_cadastro_medico.d_nascimento', 'tb_cadastro_medico.nome', 'tb_especialidade.descricao as id_especialidade'
                )->join('tb_especialidade', 'tb_especialidade.id', '=', 'tb_cadastro_medico.id_especialidade');
    }

    public function saveOrUpdate($pData, $pId = null) {

        $dateNow = \Carbon\Carbon::now()->toDateTimeString();

        $pData['updated_at'] = $dateNow;

        $pData['d_nascimento'] = \Carbon\Carbon::parse($pData['d_nascimento'])->format('Y-m-d');

        if ($pId != null) {
            Medicos::find($pId)->update($pData);
        } else {
            
//            dd($pData);
            $medicos = new Medicos();
            $medicos->nome = $pData['nome'];
            $medicos->cpf = $pData['cpf'];
            $medicos->crm = $pData['crm'];
            $medicos->d_nascimento = $pData['d_nascimento'];
            $medicos->sexo = $pData['sexo'];
            $medicos->id_especialidade = $pData['id_especialidade'];
            $medicos->updated_at = $dateNow;
            $medicos->created_at = $dateNow;
            $medicos->save();
        }
    }

//    public function gridLst() {
//        return $this->join('tb_especialidade', 'tb_especialidade.id', '=', 'tb_cadastro_medico.id_especialidade')
//                        ->select('tb_cadastro_medico.id','tb_cadastro_medico.crm', 'tb_cadastro_medico.cpf', 'tb_cadastro_medico.nome', 'tb_cadastro_medico.d_nascimento', 'tb_especialidade.descricao as especialidade');
//    }
}
