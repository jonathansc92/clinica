
<div class="row">
    <div class='col-md-6'>
        <div class='form-group'>
            {!!Form::label('data', 'Data do Agendamento')!!}
            {!! Form::text('data', null,['required'=>'required','class'=>'datepicker form-control', 'data-mask'=>'00/00/0000']) !!}
        </div>
    </div>

    <div class='col-md-6'>
        <div class='form-group'>
            {!!Form::label('hora', 'Hora do Agendamento')!!}
            {!! Form::text('hora', null,['id'=>'timepicker','required'=>'required','class'=>'form-control']) !!}
        </div>
    </div>

    <div class='col-md-12'>
        <div class='form-group'>
            {!!Form::label('id_medico', 'Médico')!!}
            {!! Form::select('id_medico', $medicos, isset($data->id_medico)?$data->id_medico:null, ['class'=>'form-control']); !!}
        </div>
    </div>

    <div class='col-md-12'>
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

<script type="text/javascript">
    $(document).ready(function () {
        $('#timepicker').timepicker({
            showMeridian: false
        });
    });
</script>