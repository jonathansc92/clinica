@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Editar Médico" icon="edit"></pagetitlebox>

<panel size="12">
{!! Form::open(['url' => '/especialidades/update/'. $especialidades->id, 'id'=>'form']) !!}
    @include('especialidades.fields')
{!! Form::close() !!}
</panel>

@endsection