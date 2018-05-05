<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    
    public function medicos(){
        return $this->belongsTo(\App\Models\Medicos::class, 'id_especialidade');
    }

}
