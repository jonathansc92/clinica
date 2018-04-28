<template>
    <div v-bind:class="defineSize">

<div class="form-group clearfix">
        <label v-bind:for="name" v-if="label">{{label}}</label>

        <div class="col-sm-12 padding-left-0 padding-right-0">
            <input v-if="!multi" type="file" v-bind:name="name" v-bind:id="id" />
            <input v-if="multi" type="file" name="files[]" id="filer_input2" multiple="multiple" />
        </div>
</div>
</div>

</template>

<script>
    export default {
        props: ['label', 'id', 'name', 'multi', 'placeholder', 'value', 'size'],
        computed: {
            defineSize: function(){
                return "col-md-"+(this.size || 12);
            }
        }
    }


</script>
