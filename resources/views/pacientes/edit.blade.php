@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Editar Paciente" icon="edit"></pagetitlebox>

<panel size="12">
{!! Form::open(['url' => '/pacientes/update/'. $data->id, 'id'=>'form']) !!}
    @include('pacientes.fields')
{!! Form::close() !!}

</panel>

@endsection
