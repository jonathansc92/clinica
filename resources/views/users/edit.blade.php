@extends('layouts/app')
@section('content') 

<pagetitlebox size='12' title="{{$var['title']}}" icon="user"></pagetitlebox>

<panel size="12">

    {!! Form::open(['url' => '/usuario/atualizarPerfil/'.$var['user']->id, 'enctype'=>'multipart/form-data']) !!}

       @include('users/fields')

    {!! Form::close() !!}
    
</panel>

@endsection