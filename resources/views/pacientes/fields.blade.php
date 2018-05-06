@if(isset($data->id))
{!! Form::hidden('id', $data->id) !!}
@endif

<div class='row'>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', isset($data->nome)?$data->nome:null, ['required'=>'required','class' => 'form-control', 'placeholder'=>'Digite um nome']) !!}

        </div>
    </div>
</div>

<div class='row'>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('cpf', 'CPF') !!}
            {!! Form::number('cpf', isset($data->cpf)?$data->cpf:null, ['class'=>'form-control', 'placeholder'=>'Digite o número de CPF'])!!}
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
            {!!Form::label('d_nascimento', 'Data de Nascimento')!!}
            {!! Form::date('d_nascimento', isset($data->d_nascimento)?$data->d_nascimento:null,['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class='form-group'>
            {!!Form::label('id_plano', 'Plano')!!}
            {!! Form::select('id_plano', $planos, ($data->id_plano) ? $data->id_plano : null, ['class'=>'form-control']); !!}
        </div>
    </div>
</div>

<div class="pull-right">
    <a href='/pacientes' class='btn btn-danger'> Cancelar</a>
    {!! Form::button('Salvar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  !!}
</div>