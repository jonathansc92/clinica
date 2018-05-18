@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Editar Especialidade" icon="edit"></pagetitlebox>

<panel size="12">
{!! Form::open(['url' => '/especialidades/store', 'id'=>'form']) !!}
    @include('especialidades.fields')
{!! Form::close() !!}
</panel>

@endsection
