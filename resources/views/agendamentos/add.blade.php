@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Editar Agendamento" icon="edit"></pagetitlebox>

<panel size="12">
{!! Form::open(['url' => '/agendamentos/store', 'id'=>'form']) !!}
    @include('agendamentos.fields')
{!! Form::close() !!}
</panel>

@endsection
