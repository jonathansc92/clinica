@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Editar Especialidade" icon="edit"></pagetitlebox>

<panel size="12">
    {!! Form::open(['url' => '/medicos/update/'. $data->id, 'id'=>'form']) !!}
    @include('medicos.fields')
    {!! Form::close() !!}
</panel>

@endsection