<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Date;

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
    
    public function pacientes(){
        return $this->belongsTo(\App\Models\Pacientes::class, 'id_plano');
    }
    
    public function saveOrUpdate($pData, $pId){
                
        $pData['updated_at'] = Date::dateTimeNow();
               
        if ($pId != null) {
             Planos::find($pId)->update($pData);
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
