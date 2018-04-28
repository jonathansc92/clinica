<template>
    <div v-bind:class="defineSize">
        <div class='form-group'>
            <label v-bind:for="name" v-if="label">{{label}}</label>
            <select v-if="!multi && !select2" class="form-control" >
                <option v-if="empty"></option>
                <option  v-for="item in itens" value="item.id" >{{item.description}}</option>

            </select>
            <select v-if="multi" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="placeholder">
                <option v-if="empty"></option> 
                <option v-for="item in itens" value="item.id" >{{item.description}}</option>

            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['type', 'css', 'label', 'id', 'name', 'multi', 'placeholder', 'value', 'size', 'itens', 'select2', 'empty'],
        computed: {
            defineSize: function(){
                return "col-md-"+(this.size || 12);
            }
        }
    }

$(document).ready(function() {
    $('.select2').select2();
});
</script>
