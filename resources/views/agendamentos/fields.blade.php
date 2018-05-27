<link href="{{ asset('theme/uplon-admin/plugins/clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('theme/uplon-admin/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<div class="row">
    <div class='col-md-6'>
        <div class='form-group'>
            {!!Form::label('data_hora', 'Data')!!}
            {!! Form::text('data_hora', null,['required'=>'required','class'=>'datepicker form-control']) !!}
        </div>
    </div>
    
    <div class='col-md-6'>
         {!!Form::label('hora', 'Horário')!!}
        <div class="form-group clockpicker">
            {!! Form::text('hora', null,['required'=>'required','class'=>'form-control']) !!}
        </div>
    </div>

    <div class='col-md-6'>
        <div class='form-group'>
            {!!Form::label('status', 'Status')!!}
            {!! Form::select('status', ['1'=>'Confirmado', '2'=>'Cancelado'], isset($data->status)?$data->status:null, ['class'=>'form-control']); !!}
        </div>
    </div>

    <div class='col-md-6'>
        <div class='form-group'>
            {!!Form::label('id_medico', 'Médico')!!}
            {!! Form::select('id_medico', $medicos, isset($data->id_medico)?$data->id_medico:null, ['class'=>'form-control']); !!}
        </div>
    </div>

    <div class='col-md-6'>
        <div class='form-group'>
            {!!Form::label('id_paciente', 'Pacientes')!!}
            {!! Form::select('id_paciente', $pacientes, isset($data->id_paciente)?$data->id_paciente:null, ['class'=>'form-control']); !!}
        </div>
    </div>
</div>


<div class="pull-right">
    <a href='/agendamentos' class='btn btn-danger'> Cancelar</a>
    {!! Form::button('Salvar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  !!}
</div>

<script src="{{ asset('theme/uplon-admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('theme/uplon-admin/plugins/clockpicker/bootstrap-clockpicker.js') }}"></script>

<script>

$(document).ready(function () {
//    $.datepicker.setDefaults($.datepicker.regional['pt-br']);
// Date Picker
    $('.datepicker').datetimepicker({
        dateFormat: "dd/mm/yyyy",
        timeFormat:  "hh:mm:ss",

        locale: 'pt-br'
    });

});
</script>

<script type="text/javascript">
$('.clockpicker').clockpicker({
    placement: 'top',
    align: 'left',
    donetext: 'Done'
});
</script>