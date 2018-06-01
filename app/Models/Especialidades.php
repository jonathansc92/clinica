<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Date;

class Especialidades extends Model {

    protected $fillable = [
        'id',
        'descricao',
        'valor_consulta',
        'created_at',
        'updated_at'
    ];
    protected $table = 'tb_especialidade';
    protected $primaryKey = 'id';

    public function __construct() {
        
    }

    public function medicos() {
        return $this->belongsTo(\App\Models\Medicos::class, 'id_especialidade');
    }

    public function saveOrUpdate($pData, $pId = null) {

        $pData['updated_at'] = Date::dateTimeNow();

        if ($pId != null) {
            Especialidades::find($pId)->update($pData);
        } else {
            $especialidade = new Especialidades();
            $especialidade->descricao = $pData['descricao'];
            $especialidade->valor_consulta = $pData['valor_consulta'];
            $especialidade->created_at = Date::dateTimeNow();
            $especialidade->save();

            return $especialidade->id;
        }
    }

}
