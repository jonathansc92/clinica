@if(isset($planos->id))
{!! Form::hidden('id', $planos->id) !!}
@endif

<div class="row">
    <div class='col-md-6'>
        <div class='form-group'>
            {!!Form::label('descricao', 'Descrição')!!}
            {!! Form::text('descricao', isset($especialidades->descricao)?$especialidades->descricao:null, ['required'=>'required','class' => 'form-control']) !!}
        </div>
    </div>

    <div class='col-md-6'>
        <div class='form-group'>
            {!!Form::label('valor_consulta', 'Valor da Consulta')!!}
            {!! Form::number('valor_consulta', isset($especialidades->valor_consulta)?$especialidades->valor_consulta:null, ['required'=>'required','class' => 'form-control']) !!}
        </div>
    </div>
</div>


<div class="pull-right">
    <a href='/especialidades' class='btn btn-danger'> Cancelar</a>
    {!! Form::button('Salvar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  !!}
</div>
