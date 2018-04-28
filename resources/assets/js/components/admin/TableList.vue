<template>
<div>               
    <a v-if='create && !modal' v-bind:href='create' title='Adicionar' class='btn btn-success'><i class='fa fa-plus'></i> Adicionar</a>

    <modal-link v-if="modal" type='link' title="Adicionar" animation='fadein' css='btn btn-success' icon='fa fa-plus' custom='add'></modal-link>
         
    <table v-bind:id="tableid" class="table table-striped table-hover">
        <thead>
            <tr>
                <th v-for="title in titles">{{ title }}</th>       
            </tr>
        </thead>

        <tbody>
            <tr v-for="(item,index) in itens">
                <td v-for="i in item">{{i}}</td>
                <td v-if="view || edit || del">

                   <form v-bind:id="index" v-if="del && token" method='post' v-bind:action="del + item.id" v-bind:token='token'>
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" v-bind:value="token" />

                        <!--View-->
                        <a v-if='view && !modal' v-bind:href='view' title='Visualizar' class='btn btn-info'> <i class='fa fa-eye'></i> Ver</a>
                        <modal-link v-if="view && modal" type='link' title="Visualizar" animation='fadein' css='btn btn-info' icon='fa fa-eye' custom='view' v-bind:item="item" v-bind:url="view">
                        </modal-link>

                        <!--Disable-->
                        <a v-if='disable && !modal' v-bind:href='disable' title='Desativar' class='btn btn-warning'> <i class='fa fa-ban'></i> Desativar</a>
                        <modal-link v-if="disable && modal"
                            type='link' 
                            title="Desativar" 
                            animation='fadein' 
                            css='btn btn-warning' 
                            icon='fa fa-ban' 
                            custom='disable'>
                        </modal-link>

                        <!--Edit-->
                        <a v-if='edit && !modal' v-bind:href='edit' title='Editar' class='btn btn-primary'> <i class='fa fa-pencil-square-o'></i> Editar</a>
                        <modal-link v-if="modal"
                            v-bind:item="item"
                            v-bind:url="edit"
                            type='link' 
                            title="Editar" 
                            animation='fadein' 
                            css='btn btn-primary' 
                            icon='fa fa-pencil-square-o' 
                            custom='edit'>

                        </modal-link>
                                     
                        <!--Delete-->
                        <a  v-if='del && token' href='#' v-on:click="runForm(index)" class="waves-effect waves-light m-r-5 m-b-10 btn btn-danger">
                            <i class='fa fa-trash-o'></i> Deletar
                        </a>

                    </form>

                        <span v-if="!token">
                        <!--View-->
                        <a v-if='view && !modal' v-bind:href='view' title='Visualizar' class='btn btn-info'> <i class='fa fa-eye'></i> Ver</a>
                        <modal-link v-if="view && modal"
                            type='link' 
                            title="Visualizar" 
                            animation='fadein' 
                            css='btn btn-info' 
                            icon='fa fa-eye' 
                            custom='view'
                            v-bind:item="item"
                            v-bind:url="view"
                        >
                        </modal-link>

                        <!--Disable-->
                        <a v-if='disable && !modal' v-bind:href='disable' title='Desativar' class='btn btn-warning'> <i class='fa fa-ban'></i> Desativar</a>
                        <modal-link v-if="disable && modal"
                            type='link' 
                            title="Desativar" 
                            animation='fadein' 
                            css='btn btn-warning' 
                            icon='fa fa-ban' 
                            custom='disable'>
                        </modal-link>

                        <!--Edit-->
                        <a v-if='edit && !modal' v-bind:href='edit' title='Editar' class='btn btn-primary'> <i class='fa fa-pencil-square-o'></i> Editar</a>
                        <modal-link v-if="modal"
                            v-bind:item="item"
                            v-bind:url="edit"
                            type='link' 
                            title="Editar" 
                            animation='fadein' 
                            css='btn btn-primary' 
                            icon='fa fa-pencil-square-o' 
                            custom='edit'>

                        </modal-link>
                                     
                        </span>

                        
                        <span v-if="token && !del">

                        <!--View-->
                        <a v-if='view && !modal' v-bind:href='view' title='Visualizar' class='btn btn-info'> <i class='fa fa-eye'></i> Ver</a>
                        <modal-link v-if="view && modal"
                            type='link' 
                            title="Visualizar" 
                            animation='fadein' 
                            css='btn btn-info' 
                            icon='fa fa-eye' 
                            custom='view'
                            v-bind:item="item"
                            v-bind:url="view"
                        >
                        </modal-link>

                        <!--Disable-->
                        <a v-if='disable && !modal' v-bind:href='disable' title='Desativar' class='btn btn-warning'> <i class='fa fa-ban'></i> Desativar</a>
                        <modal-link v-if="disable && modal"
                            type='link' 
                            title="Desativar" 
                            animation='fadein' 
                            css='btn btn-warning' 
                            icon='fa fa-ban' 
                            custom='disable'>
                        </modal-link>


                        <!--Edit-->
                        <a v-if='edit && !modal' v-bind:href='edit' title='Editar' class='btn btn-primary'> <i class='fa fa-pencil-square-o'></i> Editar</a>
                        <modal-link v-if="modal"
                             v-bind:item="item"
                             v-bind:url="edit"
                             type='link' 
                             title="Editar" 
                             animation='fadein' 
                             css='btn btn-primary' 
                             icon='fa fa-pencil-square-o' 
                             custom='edit'>

                         </modal-link>
                        </span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
    export default {
        props: ['titles', 'itens', 'create', 'edit', 'del', 'disable', 'view', 'tableid', 'modal', 'token'],
        methods:{
            runForm: function(index){
                document.getElementById(index).submit();
            }
         }
    }

            $(document).ready(function () {
    $('#datatable').DataTable({
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