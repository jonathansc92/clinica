<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Date;

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

        $pData['updated_at'] = Date::dateTimeNow();

        $pData['d_nascimento'] = \Carbon\Carbon::parse($pData['d_nascimento'])->format('Y-m-d');

        if ($pId != null) {
            Pacientes::find($pId)->update($pData);
        } else {
            $paciente = new Pacientes();
            $paciente->created_at = Date::dateTimeNow();
            $paciente->id_plano = $pData['id_plano'];
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
