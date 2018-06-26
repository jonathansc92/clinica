<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Date;
use App\Libs\ValidatorCPFCNPJ;
use Illuminate\Support\Facades\Log;

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

    public static function rules() {
        return [
            'cpf' => 'required|',
            'nome' => 'required',
            'd_nascimento' => 'required',
            'sexo' => 'required',
            'plano' => 'required'
        ];
    }

    public function saveOrUpdate($pData, $pId = null) {

        $validacpf = new ValidatorCPFCNPJ($pData['cpf']);

        if ($validacpf->validate_cpf() == false) {
            Log::error("### Cadastro de Pacientes ### CPF " . $pData['cpf'] . ", é Inválido. ");
            return 'CPF Inválido.';
        }

        $pData['cpf'] = str_replace(array("-", "."), array("", ""), $pData['cpf']);

        $verifyDoubleKeycpf = Pacientes::where('cpf', $pData['cpf'])->where('id', '<>', $pId)
                        ->select('nome', 'cpf', 'id')->first();

        if ($verifyDoubleKeycpf) {
            Log::error("### Cadastro de Pacientes ### CPF " . $pData['cpf'] . ", já consta cadastrado para o dado de ID " . $verifyDoubleKeycpf->id);
            return 'CPF, já consta cadastrado em outro paciente.';
        }

        $pData['updated_at'] = Date::dateTimeNow();
        $pData['d_nascimento'] = Date::convertBRToUSA($pData['d_nascimento'], 'N');

        if ($pId != null) {
            Pacientes::find($pId)->update($pData);
            return $pId;
        } else {
            $paciente = new Pacientes();
            $paciente->created_at = Date::dateTimeNow();
            $paciente->id_plano = $pData['id_plano'];
            $paciente->d_nascimento = $pData['d_nascimento'];
            $paciente->nome = $pData['nome'];
            $paciente->save();
            return $paciente->id;
        }
    }

    public function gridLst() {
        return $this->select(
                                'tb_paciente.id', 'cpf', 'nome', 'd_nascimento', 'sexo', 'tb_plano.descricao as id_plano')
                        ->join('tb_plano', 'tb_plano.id', '=', 'tb_paciente.id_plano')->OrderBy('nome', 'ASC');
    }

    public function plano() {
        return $this->belongsTo(\App\Models\Planos::class, 'id_plano');
    }

}
