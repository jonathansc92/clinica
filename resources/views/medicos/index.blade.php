@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="Lista de {{$displayName}}" icon="user-md"></pagetitlebox>

<panel size="12">
    <div class='row'>
        <button id="getModal" class="btn btn-success" 
                data-title="Adicionar" 
                data-toggle="modal" 
                data-target=".modal" 
                data-url="/medicos/add/"><i class='fa fa-plus'></i> Adicionar</button>
    </div>
    @include('medicos.table')
</panel>

<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
<script>
    $(document).ready(function () {

        $('#medicos').DataTable({
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
            "ajax": '/medicos/data',

            columns: [
                {data: 'crm', name: 'crm'},
                {data: 'nome', name: 'nome'},
                {data: 'd_nascimento', name: 'd_nascimento'},
                {data: 'cpf', name: 'cpf'},
                {data: 'especialidade', name: 'especialidade'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}]

        });
    });
</script>

@endsection