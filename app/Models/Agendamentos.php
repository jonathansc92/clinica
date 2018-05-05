<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamentos extends Model {

    protected $fillable = [
        'id',
        'id_plano',
        'id_paciente',
        'id_medico',
        'id_especialidade',
        'data_hora',
        'created_at',
        'updated_at'
    ];
    protected $table = 'tb_agendamento';
    protected $primaryKey = 'id';

    public function __construct() {
        
    }

}
