<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\ValidatorCPFCNPJ;
use App\Libs\Date;
use Illuminate\Support\Facades\Log;

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
                )->join('tb_especialidade', 'tb_especialidade.id', '=', 'tb_cadastro_medico.id_especialidade')->OrderBy('tb_cadastro_medico.nome', 'ASC');
    }

    public function saveOrUpdate($pData, $pId = null) {

        $validacpf = new ValidatorCPFCNPJ($pData['cpf']);

        if ($validacpf->validate_cpf() == false) {
            Log::error("### Cadastro de Médicos ### CPF " . $pData['cpf'] . ", é Inválido. ");
            return 'CPF Inválido.';
        }

        $pData['cpf'] = str_replace(array("-", "."), array("", ""), $pData['cpf']);

        $verifyDoubleKeycpf = Medicos::where('cpf', $pData['cpf'])->where('id', '<>', $pId)
        ->select('nome', 'cpf', 'id')->first();

        if ($verifyDoubleKeycpf) {
            Log::error("### Cadastro de Médicos ### CPF " . $pData['cpf'] . ", já consta cadastrado para o dado de ID " . $verifyDoubleKeycpf->id);
            return 'CPF, já consta cadastrado em outro paciente.';
        }

        $dateNow = \Carbon\Carbon::now()->toDateTimeString();

        $pData['updated_at'] = $dateNow;

        $pData['d_nascimento'] = Date::convertBRToUSA($pData['d_nascimento'], 'N');

        if ($pId != null) {
            $medico = Medicos::find($pId)->update($pData);
            return $pId;
        } else {
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
            return $medicos->id;
        }
    }

//    public function gridLst() {
//        return $this->join('tb_especialidade', 'tb_especialidade.id', '=', 'tb_cadastro_medico.id_especialidade')
//                        ->select('tb_cadastro_medico.id','tb_cadastro_medico.crm', 'tb_cadastro_medico.cpf', 'tb_cadastro_medico.nome', 'tb_cadastro_medico.d_nascimento', 'tb_especialidade.descricao as especialidade');
//    }
}
