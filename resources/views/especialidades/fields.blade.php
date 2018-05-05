@if(isset($planos->id))
{!! Form::hidden('id', $planos->id) !!}
@endif

<div class='form-group'>
    {!!Form::label('descricao', 'Descrição')!!}
    {!! Form::text('descricao', isset($planos->descricao)?$planos->descricao:null, ['required'=>'required','class' => 'form-control']) !!}
</div>

<div class='form-group'>
    {!!Form::label('cnpj', 'CNPJ')!!}
    {!! Form::text('cnpj', isset($planos->cnpj)?$planos->cnpj:null, ['required'=>'required','class' => 'form-control']) !!}
</div>

<div class='form-group'>

    {!!Form::label('contato', 'Contato')!!}
    {!! Form::text('contato', isset($planos->contato)?$planos->contato:null, ['required'=>'required','class' => 'form-control']) !!}

</div>
