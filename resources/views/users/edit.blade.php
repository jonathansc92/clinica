@extends('layouts/app')
@section('content') 

<pagetitlebox size='12' title="{{$var['title']}}" icon="user"></pagetitlebox>

<panel size="12">

    {!! Form::open(['url' => '/user/update/'.$var['user']->id, 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

       @include('users/fields')

    {!! Form::close() !!}
</panel>

@endsection