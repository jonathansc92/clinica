<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planos extends Model {

    protected $fillable = [
        'id',
        'descricao',
        'cnph',
        'contato',
        'created_at',
        'updated_at'
    ];
    protected $table = 'tb_plano';
    protected $primaryKey = 'id';

    public function __construct() {
        
    }

}
