<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamentos extends Model {

    protected $fillable = [
        'id',
        'id_paciente',
        'id_medico',
        'status',
        'data_hora',
        'created_at',
        'updated_at'
    ];
    protected $table = 'tb_agendamento';
    protected $primaryKey = 'id';

    public function __construct() {
        
    }
    
    public function medico(){
        return $this->belongsTo(\App\Models\Medicos::class, 'id_medico');
    }
    
    public function paciente(){
        return $this->belongsTo(\App\Models\Pacientes::class, 'id_paciente');
    }

}
