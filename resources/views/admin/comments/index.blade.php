@extends('admin/layouts/app')
@section('content')


<pagetitlebox size='12' title="Lista de Mensagens" icon="envelope"></pagetitlebox>

<panel size="12">

    <div class='row'>
        @include('flash::message')
    </div>

    <table id="comments" class="table table-striped table-hover">
        <thead>
            <tr>
                <th style="text-align: center">Nome</th>
                <th style="text-align: center">Email</th>
                <th style="text-align: center">Visto?</th>
                <th style="text-align: center">#</th>

            </tr>
        </thead>
    </table>

    <script>
        $(document).ready(function () {

            $('#comments').DataTable({
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
                "processing": 'Processando',
                "serverSide": true,
                "ajax": '/datatables/comments',
                "filter": true,

                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'view', name: 'view'},
                    {
                        "data": null,
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a class='btn btn-info' href='/admin/comentario/view/" + oData.id + "'><i class='fa fa-eye'></i> Ver</a>");
                        }, "searchable": false
                    },
                ],
            });
        });
    </script>
    @endsection