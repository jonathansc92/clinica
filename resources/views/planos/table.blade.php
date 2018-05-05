@extends('layouts/app')
@section('content')


    <pagetitlebox size='12' title="Lista de Posts" icon="newspaper-o"></pagetitlebox>

    <panel size="12">

        <div class='row'>
                <a href="" class="btn btn-success"><span class="fa fa-plus"></span> Adicionar</a>
        </div>

        <table id="posts" class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="text-align: center">Titulo</th>
                <th style="text-align: center">Ativo?</th>
                <th style="text-align: center">Em destaque?</th>
                <th style="text-align: center">#</th>

            </tr>
            </thead>
        </table>

        <script>
            $(document).ready(function () {

                $('#posts').DataTable({
                    select: true,
                    "lengthChange": false,
                    "language": {
//            "sLengthMenu": "Mostrar _MENU_ registros por p&aacute;gina",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
//            "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                        "sInfoFiltered": "(filtrado de _MAX_ registros)",
                        "sSearch": "Pesquisar: ",
                        "paginate": {
                            "previous": "Anterior",
                            "next": "Pr&oacute;ximo"
                        }
                    },
                    "processing": true,
                    "serverSide": true,
                    "ajax": @if(Request::segment(2) == 'posts')  '/datatables/posts' @else '/datatables/tips' @endif,
                    "filter": true,

                    columns: [
                        {data: 'title', name: 'title'},
                        {data: 'active', name: 'active'},
                        {data: 'feature', name: 'feature'},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false}]

                });
            });
        </script>
@endsection