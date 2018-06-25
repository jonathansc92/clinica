<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Date;
use App\Libs\ValidatorCPFCNPJ;

class Planos extends Model {

    protected $fillable = [
        'id',
        'descricao',
        'cnpj',
        'contato',
        'created_at',
        'updated_at'
    ];
    protected $table = 'tb_plano';
    protected $primaryKey = 'id';

    public function __construct() {
        
    }

    public function pacientes() {
        return $this->belongsTo(\App\Models\Pacientes::class, 'id_plano');
    }

    public function saveOrUpdate($pData, $pId)
    {

        $validacpf = new ValidatorCPFCNPJ($pData['cnpj']);

        if ($validacpf->validate_cnpj() == false) {
            return 'CNPJ Inválido';
        }

        $pData['cnpj'] = str_replace(array("-", ".", "/"), array("", "", ""), $pData['cnpj']);

        $verifyDoubleKeycnpj = Planos::where('cnpj', $pData['cnpj']);
         if ($pId) {
             $verifyDoubleKeycnpj->where(function($verifyDoubleKeycnpj){
                 $verifyDoubleKeycnpj->where('id','<>',$pId);
             });
         }

        $verifyDoubleKeycnpj->first();

        if ($verifyDoubleKeycnpj) {
            return 'CNPJ, já consta cadastrado em outro paciente.';
        }

        $pData['updated_at'] = Date::dateTimeNow();

        if ($pId != null) {
            Planos::find($pId)->update($pData);
            return $pId;
        } else {
            $plano = new Planos();
            $plano->created_at = Date::dateTimeNow();
            $plano->descricao = $pData['descricao'];
            $plano->contato = $pData['contato'];
            $plano->save();
            return $plano->id;
        }
    }

}
