@extends('admin/layouts/app')
@section('content')


    <pagetitlebox size='12' title="Lista de Posts" icon="newspaper-o"></pagetitlebox>

    <panel size="12">

        <div class='row'>
            @include('flash::message')
        </div>

        <div class='row'>
            <a href="/admin/posts/add" class="btn btn-success"><span class="fa fa-plus"></span> Adicionar</a>
        </div>

        <div class="row">
            <table class="table table-striped table-hover" id="tbposts">
                <tr>
                    <th align="center">ID</th>
                    <th align="center">Titulo</th>
                    <th align="center">Ativado?</th>
                    <th align="center">Destaque?</th>
                    <th align="center"></th>
                </tr>
                @foreach($var['postsLst'] as $post)
                    <tr>
                        <td align="center">{{$post['id']}}</td>
                        <td align="center">{{$post['title']}}</td>
                        <td align="center">@if($post['active'] == 'S')<span style="color: green" class="fa fa-check"></span>@else <span style="color: red" class="fa fa-times"></span>@endif</td>
                        <td align="center">@if($post['feature'] == 'S')<span style="color: green" class="fa fa-check"></span>@else <span style="color: red" class="fa fa-times"></span>@endif</td>
                        <td>
                            <a href="/admin/posts/edit/{{$post['id']}}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                            <a href="/admin/posts/del/{{$post['id']}}" class="btn btn-danger"><i class="fa fa-trash"></i> Deletar</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        <script>
            $(document).ready(function () {
                $('#tbposts').DataTable({
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
                    }
                });

            });
        </script>

@endsection