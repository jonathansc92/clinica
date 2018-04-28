@extends('admin/layouts/app')


@section('content') 

<link href="{{ asset('theme/uplon-admin/plugins/custombox/css/custombox.min.css') }}" rel="stylesheet">

<!-- DataTables -->
<link href="{{ asset('theme/uplon-admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('theme/uplon-admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet">


<pagetitlebox size='12' title="Lista de Categorias" icon="newspaper-o"></pagetitlebox>

<panel size="12">

    <div class='row'>
        @include('flash::message')
    </div>

    <table-list 
        v-bind:titles="['#', 'Titulo', '']"
        v-bind:itens="{{$var['dataLst']}}"
        create='/admin/categorias/'
        edit="/admin/categorias/"
        modal='S'
        token="{{csrf_token()}}"
        tableid='datatable'
        >

    </table-list>

    <div class="row">
        laal
        <ckeditor
            id="addContent"
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
</panel>

<modal v-bind:title='$store.state.item.title' icon='' id='view'>
    @{{$store.state.item.content}}
</modal>

<modal-bootstrap
    id='add'
    title='Adicionar'
    icon='fa fa-plus'
    submit='S'
    >
    <cform enctype="multipart/form-data" method='post' action="{{route('categorias.store')}}" token="{{csrf_token()}}" >

        <div class="row">
            <cinput value="{{old('description')}}" placeholder="Digite a categoria" label="Categoria" css="form-control" type="text" name="description" id="description" req="required"></cinput>
        </div>

        <cbutton css='btn btn-success' title='Adicionar' icon='fa fa-save'></cbutton>
    </cform>  
</modal-bootstrap>

<modal-bootstrap
    id='edit'
    v-bind:title="'Editar categoria: '+ $store.state.item.description"
    icon='fa fa-pencil-square-o'
    submit='S'
    >
    <cform enctype="multipart/form-data" method="put" v-bind:action="'/admin/categorias/'+$store.state.item.id"  token="{{csrf_token()}}">

        <div class="row">
            <cinput v-model="$store.state.item.description" value="{{old('description')}}" placeholder="Digite a categoria" label="Categoria" css="form-control" type="text" name="description" id="description" req="required"></cinput>
        </div>

        <cbutton css='btn btn-success' title='Atualizar' icon='fa fa-save'></cbutton>

    </cform>
</modal>

<!-- Modal-Effect -->
<script src="{{ asset('theme/uplon-admin/plugins/custombox/js/custombox.min.js') }}"></script>
<script src="{{ asset('theme/uplon-admin/plugins/custombox/js/legacy.min.js') }}"></script>





<script>
$(document).ready(function () {
    $('.select2').select2();
});
</script>


@endsection