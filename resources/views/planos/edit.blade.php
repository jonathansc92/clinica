@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Editar Plano" icon="edit"></pagetitlebox>

<panel size="12">
{!! Form::open(['url' => '/planos/update/'. $planos->id, 'id'=>'formModal']) !!}
    @include('planos.fields')
{!! Form::close() !!}

</panel>

@endsection
