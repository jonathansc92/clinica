@extends('layouts/app')
@section('content') 
<page>

    <pagetitlebox size='12' title="Lista de Posts" icon="newspaper-o"></pagetitlebox>

    <panel size="12">

        @if($errors->all())
        @foreach($errors->all() as $key => $value)
        <calert type="danger" msg='Erro'>
            {{$value}}
        </calert>
        @endforeach
        @endif   



        <table-list 
            v-bind:titles="['#', 'Titulo', 'Ativo', 'Destaque', '']"
            v-bind:itens="{{$var['postsLst']}}"
            create='/admin/posts/'
            edit="/admin/posts/"
            del='/admin/posts/'
            view='/admin/posts/'
            modal='S'
            token="{{csrf_token()}}"
            tableid='datatable'
            >

        </table-list>
        <div class="row">

            <ckeditor
                id="addContent"
                name="content"
                value="{{old('content')}}"
                v-bind:config="{
                toolbar:[
                [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                ],
                height: 300
                }" >
            </ckeditor>
        </div>
    </panel>

    <modal v-bind:title='$store.state.item.title' icon='' id='view'>
        @{{$store.state.item.content}}
    </modal>

    <modal-bootstrap
        id='l'
        title='Adicionar'
        icon='fa fa-plus'
        submit='S'
        >
        <cform enctype="multipart/form-data" method='post' action="{{route('posts.store')}}" token="{{csrf_token()}}" >
            <div class="row">
                <cupload size="12" label="Imagem" name="imgdefault" id="" ></cupload>

            </div>

            <div class="row">
                <check-box size="6" label="Ativo?" css="form-control" type="text" name="active" id="active" ></check-box>

                <check-box size="6" label="Destacar?" css="form-control" type="text" name="feature" id="feature" ></check-box>
            </div>

            <div class="row">
                <cinput  size='6' value="{{old('title')}}" placeholder="Digite o titulo" label="Titulo" css="form-control" type="text" name="title" id="title" req="required"></cinput>

                <input-date size='6' value="{{old('content')}}" label="Data" css="form-control" type="data" name="data" id="data" ></input-date>

            </div>

            <div class="row">

                <ctext-area 
                    size=""     
                    placeholder="Digite o titulo" 
                    label="Conteúdo" 
                    css="form-control" 
                    name="content" 
                    id="post" value="{{old('content')}}"></ctext-area>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">Categoria</label>
                        <select name="category[]" class="select2 form-control" multiple="multiple">
                            @foreach($var['categoryLst'] as $cat)
                            <option value="{{$cat['id']}}">{{$cat['description']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <cbutton css='btn btn-success' title='Adicionar' icon='fa fa-save'></cbutton>
        </cform>
    </modal-bootstrap>

    <modal-bootstrap
        id='edit'
        v-bind:title="'Editar post: '+ $store.state.item.title"
        icon='fa fa-plus'
        submit='S'
        >
        <cform enctype="multipart/form-data" method="put" v-bind:action="'/admin/posts/'+$store.state.item.id"  token="{{csrf_token()}}">

            <div class="row">
                <div v-if="$store.state.item.imgdefault" class="thumbnail">
                    <img width="200px" height="" v-bind:src="'http://127.0.0.1:8000/images/'+$store.state.item.imgdefault" />
                </div>

                <cupload size="12" label="Selecionar Imagem" name="imgdefault" id="" ></cupload>

            </div>

            <div class="row">
                <check-box value="S" v-model="$store.state.item.active" size="6" label="Ativo?" css="form-control" type="text" name="active" id="active" ></check-box>

                <check-box value="S"  v-model="$store.state.item.feature" size="6" label="Destacar?" css="form-control" type="text" name="feature" id="feature" ></check-box>
            </div>

            <div class="row">

                <cinput size='6' placeholder="Digite o titulo" label="Titulo" css="form-control" type="text" name="title" id="title" v-model="$store.state.item.title"></cinput>

                <input-date size='6' value="{{old('data')}}" label="Data" css="form-control" type="data" name="data" id="data" v-model="$store.state.item.data"></input-date>

            </div>

            <div class="row">

                <ctext-area 
                    size=""     
                    placeholder="Digite o titulo" 
                    label="Conteúdo" 
                    css="form-control" 
                    name="content" 
                    id="article-ckeditor" v-model="$store.state.item.content"></ctext-area>
            </div>

            <div class='row'>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">Categoria</label>
                        <select name="category[]" class="select2 form-control" multiple='multiple'>
                            @foreach($var['categoryLst'] as $cities)

                            <option v-if="$store.state.item.cities_id != '{{$cities['id']}}'" value="{{$cities['id']}}">{{$cities['description']}}</option>
                            <option selected="selected" v-if="$store.state.item.cities_id == '{{$cities['id']}}'" value="{{$cities['id']}}">{{$cities['description']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <cbutton css='btn btn-success' title='Atualizar' icon='fa fa-save'></cbutton>

        </cform>
    </modal-bootstrap>

    <!--    <modal title='Adicionar post' icon='fa fa-plus' id='add'>
            <cform enctype="multipart/form-data" method='post' action="{{route('posts.store')}}" token="{{csrf_token()}}" >
                <div class="row">
                    <cupload size="12" label="Imagem" name="imgdefault" id="" ></cupload>
    
                </div>
    
                <div class="row">
                    <check-box size="6" label="Ativo?" css="form-control" type="text" name="active" id="active" ></check-box>
    
                    <check-box size="6" label="Destacar?" css="form-control" type="text" name="feature" id="feature" ></check-box>
                </div>
    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Local</label>
                            <select name="category[]" class="select2 form-control" multiple="multiple">
                                @foreach($var['categoryLst'] as $cat)
                                <option value="{{$cat['id']}}">{{$cat['description']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <input-date size='6' value="{{old('content')}}" label="Data" css="form-control" type="data" name="data" id="data" ></input-date>
    
                </div>
    
    
    
                <div class="row">
                    <cinput value="{{old('title')}}" placeholder="Digite o titulo" label="Titulo" css="form-control" type="text" name="title" id="title" req="required"></cinput>
                </div>
    
                <div class="row">
    
                    <ctext-area 
                        size=""     
                        placeholder="Digite o titulo" 
                        label="Conteúdo" 
                        css="form-control" 
                        name="content" 
                        id="post" value="{{old('content')}}"></ctext-area>
                </div>
    
    
                <cbutton css='btn btn-success' title='Adicionar' icon='fa fa-save'></cbutton>
            </cform>
        </modal>
    
        <modal v-bind:title="'Editar post: '+ $store.state.item.title" icon='fa fa-pencil-square-o' id='edit'>
            <cform enctype="multipart/form-data" method="put" v-bind:action="'/admin/posts/'+$store.state.item.id"  token="{{csrf_token()}}">
    
                <div class="row">
                    <div v-if="$store.state.item.imgdefault" class="thumbnail">
                        <img width="200px" height="" v-bind:src="'http://127.0.0.1:8000/images/'+$store.state.item.imgdefault" />
                    </div>
    
                    <cupload size="12" label="Selecionar Imagem" name="imgdefault" id="" ></cupload>
    
                </div>
    
                <div class="row">
                    <check-box value="S" v-model="$store.state.item.active" size="6" label="Ativo?" css="form-control" type="text" name="active" id="active" ></check-box>
    
                    <check-box value="S"  v-model="$store.state.item.feature" size="6" label="Destacar?" css="form-control" type="text" name="feature" id="feature" ></check-box>
                </div>
    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Local</label>
                            <select name="category" class="select2 form-control">
                                @foreach($var['categoryLst'] as $cities)
    
                                <option v-if="$store.state.item.cities_id != '{{$cities['id']}}'" value="{{$cities['id']}}">{{$cities['description']}}</option>
                                <option selected="selected" v-if="$store.state.item.cities_id == '{{$cities['id']}}'" value="{{$cities['id']}}">{{$cities['description']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <input-date size='6' value="{{old('data')}}" label="Data" css="form-control" type="data" name="data" id="data" v-model="$store.state.item.data"></input-date>
    
                </div>
    
                <div class="row">
                    <cinput placeholder="Digite o titulo" label="Titulo" css="form-control" type="text" name="title" id="title" v-model="$store.state.item.title"></cinput>
                </div>
    
                <div class="row">
    
                    <ctext-area 
                        size=""     
                        placeholder="Digite o titulo" 
                        label="Conteúdo" 
                        css="form-control" 
                        name="content" 
                        id="post" v-model="$store.state.item.content"></ctext-area>
                </div>
                <div class="row">
    
                    <ckeditor
                        id="content"
                        name="content"
                        value="{{old('content')}}"
                        v-bind:config="{
                        toolbar: [
                        [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                        ],
                        height: 300
                        }" >
                    </ckeditor>
                </div>
                <cbutton css='btn btn-success' title='Atualizar' icon='fa fa-save'></cbutton>
    
            </cform>
        </modal>-->


</page>
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        "ajax": '../ajax/data/arrays.txt'
    } );
} );
</script>

@endsection