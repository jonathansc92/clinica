<template>

    <div  v-bind:id="id" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mySmallModalLabel">
                        <span v-bind:class="icon"></span> {{title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <slot></slot>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" v-if="submit" >Save changes</button>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
    export default {
        props: ['id', 'title', 'icon', 'submit'],
        computed: {

            defineSize: function(){
                return "col-md "+this.size
            }
            }
        
    }
</script>
