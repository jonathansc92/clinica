@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Cadastrar Médico" icon="plus"></pagetitlebox>

<panel size="12">
    {!! Form::open(['url' => '/medicos/store', 'id'=>'form']) !!}
    @include('medicos.fields')
    {!! Form::close() !!}

</panel>

@endsection