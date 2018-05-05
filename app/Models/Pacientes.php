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
        'created_at',
        'updated_at'
    ];
    protected $table = 'tb_paciente';
    protected $primaryKey = 'id';

    public function __construct() {
        
    }

}
