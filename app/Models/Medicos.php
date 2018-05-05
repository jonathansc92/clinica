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
        'id_especialidade'   
        'created_at',
        'updated_at'
    ];
    protected $table = 'tb_cadastro_medico';
    protected $primaryKey = 'id';

    public function __construct() {
        
    }

}
