@extends('admin/layouts/app')


@section('content') 

<pagetitlebox size='12' title="Editar {{$var['post']['title']}} - 
              Local: {{$var['local']}}" icon="fa fa-edit"></pagetitlebox>
<panel size="12">
    @include('flash::message')
    <cform enctype="multipart/form-data" method="put" action="/admin/posts/{{$var['post']['id']}}" token="{{csrf_token()}}">

        <div class="row">
            <img width="200px" height="150px" src="{{url('images/', $var['post']['imgdefault'])}}" />
            <cupload size="12" label="Imagem" name="imgdefault" id="" ></cupload>
        </div>

        <div class="row">
            @if($var['post']['active'] == 'S')
            <check-box checked='S' value="S" size="6" label="Ativo?" css="form-control" type="text" name="active" id="active" ></check-box>
            @else
            <check-box value="S" size="6" label="Ativo?" css="form-control" type="text" name="active" id="active" ></check-box>
            @endif

            @if($var['post']['feature'] == 'S')
            <check-box checked='S' value="S" size="6" label="Destacar?" css="form-control" type="text" name="feature" id="feature" ></check-box>
            @else
            <check-box value="S" size="6" label="Destacar?" css="form-control" type="text" name="feature" id="feature" ></check-box>
            @endif
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="category">Categoria(s)</label>
                    <select name="category[]" class="select2 form-control" multiple="multiple">
                        @foreach($var['categoryLst'] as $category)

                        <option value="{{$category->id}}" 
                                @foreach($var['post']->category as $categoryPost) 
                                @if($categoryPost->category_id == $category->id) selected=""  @endif @endforeach>
                                {{$category->description}}
                    </option>

                    @endforeach
                </select>
            </div>
        </div>


        <input-date size='6' value="{{\Carbon\Carbon::parse($var['post']->data)->format('d/m/Y')}}" label="Data" css="form-control" type="data" name="data" id="datepicker" ></input-date>

    </div>

    <div class="row">
        <cinput value="{{$var['post']['title']}}" placeholder="Digite o titulo" label="Titulo" css="form-control" type="text" name="title" id="title" req="required"></cinput>
    </div>

    <div class="row">

        <ctext-area 
            required='required'    
            label="Conteúdo" 
            css="form-control" 
            name="content" 
            value="{{$var['post']['content']}}"></ctext-area>
    </div>

    <cbutton css='btn btn-success' title='Salvar' icon='fa fa-save'></cbutton>        
</cform>
</panel>

<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
@endsection