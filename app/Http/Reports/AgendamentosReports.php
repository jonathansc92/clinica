<?php

namespace App\Http\Reports;

use Illuminate\Http\Request;
use PDF;

class AgendamentosReports {

    protected $obj;
    protected $dataFinal;
    protected $dataInicial;
    protected $agendamentos;

    public function __construct(\App\Models\Agendamentos $obj) {

        $this->obj = $obj;
    
    }

    public function geraRelatorio($pDateInitial, $pDateEnd) {
        
        $this->agendamentos = $this->obj->agendamentosByDate(\Carbon\Carbon::createFromFormat('d/m/Y',$pDateInitial), \Carbon\Carbon::createFromFormat('d/m/Y',$pDateEnd));

        return view('relatorios.relatorio-agendamentos')
                        ->with('data', $this->agendamentos);
    }

    public function doPdf($pDateInitial, $pDateEnd) {
        
        
        $data = $this->obj->agendamentosByDate(\Carbon\Carbon::createFromFormat('d-m-Y',$pDateInitial), \Carbon\Carbon::createFromFormat('d-m-Y',$pDateEnd));

        $pdf = PDF::loadView('relatorios.agendamento-download', compact('data'));
        return $pdf->download(str_replace('-', '',$pDateInitial) . '.pdf');
    }

}
