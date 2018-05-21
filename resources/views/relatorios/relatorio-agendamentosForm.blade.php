@extends('layouts/app')
@section('content') 

<link href="{{ asset('theme/uplon-admin/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<pagetitlebox size='12' title="Relatório" icon="list"></pagetitlebox>
<panel size="12">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Relatório!</h4>
        <p>Escolha o intervalo de Datas do relatório.</p>
        <p class="mb-0">Para emitir o relatório é obrigatório preencher campo Data Inicial e o campo Data Final.</p>
    </div>

    {!! Form::open(array('url' => '/agendamentos/emitirRelatorio', 'method'=>'GET', 'target'=>'_blank')) !!}


    <div class='row'>
        <div class="col-md-6">
            <div class='form-group'>
                {!!Form::label('data_inicial', 'Data Inicial')!!}
                {!! Form::text('data_inicial', null,['required'=>'required','class'=>'datepicker form-control']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class='form-group'>
                {!!Form::label('data_final', 'Data Final')!!}
                {!! Form::text('data_final',null,['required'=>'required','class'=>'datepicker form-control']) !!}
            </div>
        </div>
    </div>

    <div class="pull-right">
        {!! Form::button('Emitir Relatório', ['type' => 'submit', 'class' => 'btn btn-success'] )  !!}
    </div>

    {!! Form::close() !!}


</panel>
<script src="{{ asset('theme/uplon-admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script>

$(document).ready(function () {
//    $.datepicker.setDefaults($.datepicker.regional['pt-br']);
// Date Picker
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",

        locale: 'pt-br'
    });

});
</script>

@endsection