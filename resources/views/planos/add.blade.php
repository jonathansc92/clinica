@extends('admin/layouts/app')


@section('content') 

<pagetitlebox size='12' title="Cadastrar" icon="fa fa-plus"></pagetitlebox>
<panel size="12">
    @include('flash::message')

    <cform 
        enctype="multipart/form-data" 
        method='post' 
        action="{{route('posts.store')}}" 
        token="{{csrf_token()}}" 
        >

        @if(Request::segment(4) == 'tip')
        <input type="hidden" value="S" name="tip" />
        @else
        <input type="hidden" value="N" name="tip" />
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="country">País </label>
                    <select name="countries_id" class="form-control" id='country'></select>
                </div>
            </div>
            <div class="col-md-4" id="divCountry" style='display: none'>
                <!--<div id='loading'></div>-->
                <div class="form-group">
                    <label for="state">Estado </label>
                    <select name="state" class="form-control" id='state'></select>
                </div>
            </div>
            <div class="col-md-4" id='divCity' style='display: none'>
                <div class="form-group">
                    <label for="city">Cidade </label>
                    <select name="city" class="form-control" id='city'> </select>
                </div>
            </div>

        </div>

        <div class="row">
            <cupload size="12" label="Imagem" name="imgdefault" id="" ></cupload>
        </div>

        <div class="row">
            <check-box checked="S" value="S" size="6" label="Ativo?" css="form-control" type="text" name="active" id="active" ></check-box>

            <check-box value="S" size="6" label="Destacar?" css="form-control" type="text" name="feature" id="feature" ></check-box>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category">Categoria(s)</label>
                    <select name="category[]" class="select2 form-control" multiple="multiple">
                        @foreach($var['categoryLst'] as $cat)
                        <option value="{{$cat['id']}}">{{$cat['description']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input-date size='6' value="{{old('data')}}" label="Data" css="form-control" type="data" name="data" id="data" ></input-date>

        </div>

        <div class="row">
            <cinput value="{{old('title')}}" placeholder="Digite o titulo" label="Titulo" css="form-control" type="text" name="title" id="title" req="required"></cinput>

        </div>

        <div class="row">
            <ctext-area 
                required='required'    
                placeholder="Digite o titulo" 
                label="Conteúdo" 
                css="form-control" 
                name="content" 
                id="post" value="{{old('content')}}"></ctext-area>
        </div>

        <cbutton css='btn btn-success' title='Salvar' icon='fa fa-save'></cbutton>
    </cform>
</panel>
<script src="{{ asset('js/localAjax.js') }}"></script>


@endsection