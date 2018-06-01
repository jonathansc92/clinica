@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Lista de {{$displayName}}" icon="list-alt"></pagetitlebox>

<panel size="12">
    <div class='row'>
        <a class="btn btn-success" href="/especialidades/add/"><i class='fa fa-plus'></i> Adicionar</a>
    </div>
    @include('especialidades.table')
</panel>

<script>
    $(document).ready(function () {

        $('#especialidades').DataTable({
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
            "ajax": '/especialidades/data',

            columns: [
                {data: 'descricao', name: 'descricao'},
                {data: 'valor_consulta', name: 'valor_consulta'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}]

        });
    });
</script>

@endsection