@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Lista de {{$displayName}}" icon="calendar"></pagetitlebox>

<panel size="12">
    <div class='row'>
        <a class="btn btn-success" href="/agendamentos/add/"><i class='fa fa-plus'></i> Adicionar</a>
    </div>
    @include('agendamentos.table')
</panel>

<script>
    $(document).ready(function () {

        $('#agendamentos').DataTable({
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
            "ajax": '/agendamentos/data',

            columns: [
                {data: 'id_paciente', name: 'tb_paciente.nome'},
                {data: 'data_hora', name: 'data_hora'},
                {data: 'id_medico', name: 'tb_cadastro_medico.nome'},
                {data: 'status', name: 'status'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}]

        });
    });
</script>

@endsection