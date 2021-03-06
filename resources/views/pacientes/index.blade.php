@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Lista de {{$displayName}}" icon="user"></pagetitlebox>

<panel size="12">
    <div class='row'>
        <a href="/pacientes/add/" class='btn btn-success'><i class='fa fa-plus'></i> Adicionar</a>
    </div>
    @include('pacientes.table')
</panel>

<script>
    $(document).ready(function () {

        $('#pacientes').DataTable({
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
            "ajax": '/pacientes/data',

            columns: [
                {data: 'nome', name: 'nome'},
                {data: 'sexo', name: 'sexo'},
                {data: 'd_nascimento', name: 'd_nascimento'},
                {data: 'cpf', name: 'cpf'},
                {data: 'id_plano', name: 'tb_plano.descricao'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}]

        });
    });
</script>

@endsection