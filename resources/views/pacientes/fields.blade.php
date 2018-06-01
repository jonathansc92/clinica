<link href="{{ asset('theme/uplon-admin/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<div class='row'>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('nome', 'Nome', ['class'=>'required']) !!}
            {!! Form::text('nome', isset($data->nome)?$data->nome:null, ['required'=>'required','class' => 'form-control', 'placeholder'=>'Digite um nome']) !!}

        </div>
    </div>
</div>

<div class='row'>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('cpf', 'CPF', ['class'=>'required']) !!}
            {!! Form::number('cpf', isset($data->cpf)?$data->cpf:null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Digite o número de CPF'])!!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('sexo', 'Sexo') !!}
            {!! Form::select('sexo', ['F' => 'Feminino', 'M' => 'Masculino'], isset($data->sexo)?$data->sexo:null, ['class'=>'form-control']); !!}
        </div>
    </div>
</div>

<div class='row'>
    <div class="col-md-6">
        <div class='form-group'>
            {!!Form::label('d_nascimento', 'Data de Nascimento', ['class'=>'required'])!!}
            {!! Form::text('d_nascimento', isset($data->d_nascimento)?Carbon\Carbon::parse($data->d_nascimento)->format('d/m/Y'):null,['required'=>'required','class'=>'datepicker form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class='form-group'>
            {!!Form::label('id_plano', 'Plano')!!}
            {!! Form::select('id_plano', $planos, isset($data->id_plano) ? $data->id_plano : null, ['class'=>'form-control']); !!}
        </div>
    </div>
</div>

<div class="pull-right">
    <a href='/pacientes' class='btn btn-danger'> Cancelar</a>
    {!! Form::button('Salvar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  !!}
</div>

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