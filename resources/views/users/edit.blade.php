@extends('layouts/app')
@section('content') 

<link href="{{ asset('theme/uplon-admin/plugins/custombox/css/custombox.min.css') }}" rel="stylesheet">

<pagetitlebox size='12' title="{{$var['title']}}" icon="user"></pagetitlebox>

<panel size="12">


    {!! Form::open(['url' => '/user/update/', 'id'=>'form', 'enctype'=>'multipart/form-data']) !!}

        <cinput type="hidden" value="{{$var['user']->id}}" name="id" id="id"></cinput>

        <div  class="row">
            @if($var['user']->img)
            <div class="thumbnail">
                <img width="200px" height="200px" src="{{url('images/perfil/', $var['user']->img)}}" />
            </div>
            @endif

            <cupload size="12" label="Selecionar Imagem" name="img" id="" ></cupload>

        </div>

        <div class="row">
            <cinput  size='6' value="{{$var['user']->name}}" placeholder="Digite o nome" label="Nome" css="form-control" type="text" name="name" id="name" req="required"></cinput>
            <cinput  size='6' value="{{$var['user']->email}}" placeholder="Digite seu email" label="E-mail" css="form-control" type="email" name="email" id="email" req="required"></cinput>

        </div>

        <div class="row">
            <cinput  size='6' value="" label="Atualizar senha" css="form-control" type="password" name="password" id="password"></cinput>
            <cinput  size='6' value="" label="Confirmar senha" css="form-control" type="password" name="confirm_password" id="confirm_password"></cinput>
        </div>

        <cbutton css='btn btn-success' title='Atualizar' icon='fa fa-save'></cbutton>

    {!! Form::close() !!}
</panel>

<!-- Modal-Effect -->
<script src="{{ asset('theme/uplon-admin/plugins/custombox/js/custombox.min.js') }}"></script>
<script src="{{ asset('theme/uplon-admin/plugins/custombox/js/legacy.min.js') }}"></script>

@endsection