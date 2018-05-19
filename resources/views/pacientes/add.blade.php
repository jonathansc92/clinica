@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Cadastrar Paciente" icon="plus"></pagetitlebox>

<panel size="12">
{!! Form::open(['url' => '/pacientes/store', 'id'=>'form']) !!}
    @include('pacientes.fields')
{!! Form::close() !!}
</panel>

@endsection
