<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Date;
use App\Models\Medicos;
use App\Models\Pacientes;

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

    public function medico() {
        return $this->belongsTo(Medicos::class, 'id_medico');
    }
    
    public function especialidade() {
        return $this->medico()->especialidade();
    }

    public function paciente() {
        return $this->belongsTo(Pacientes::class, 'id_paciente');
    }
    
    public function gridLst(){
      return $this->select(
                        'tb_agendamento.id', 'data', 'tb_paciente.nome as id_paciente', 'tb_cadastro_medico.nome as id_medico', 'tb_agendamento.status'
                )
                ->join('tb_paciente', 'tb_paciente.id', '=', 'tb_agendamento.id_paciente')
                ->join('tb_cadastro_medico', 'tb_cadastro_medico.id', '=', 'tb_agendamento.id_medico')->OrderBy('data', 'DESC');
    }

    public function saveOrUpdate($pData, $pId = null) {

        $pData['updated_at'] = Date::dateTimeNow();
        $pData['data_hora'] = Date::formatUSA($pData['data_hora']);

        if ($pId != null) {
            Agendamentos::find($pId)->update($pData);
        } else {
            $agendamentos = new Agendamentos();
            $agendamentos->created_at = Date::dateTimeNow();
            $agendamentos->id_medico = $pData['id_medico'];
            $agendamentos->id_paciente = $pData['id_paciente'];
            $agendamentos->status = $pData['status'];
            $agendamentos->save();
            return $agendamentos->id;
        }
    }

}
