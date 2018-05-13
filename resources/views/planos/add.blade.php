@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Adicionar Plano" icon="edit"></pagetitlebox>

<panel size="12">

{!! Form::open(['url' => '/planos/store', 'id'=>'formModal']) !!}
    @include('planos.fields')
{!! Form::close() !!}

</panel>

@endsection
