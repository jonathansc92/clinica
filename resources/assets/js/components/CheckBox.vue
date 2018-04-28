<template>
<div v-bind:class="defineSize">

<div class='form-group'>
    <label v-bind:for="name" v-if="label">{{label}}</label>
    <input v-if="!checked" v-bind:value="value" type="checkbox" v-bind:class="css" data-color="#039cfd" data-plugin="switchery" v-bind:id="id" v-bind:name="name" v-bind:placeholder="placeholder" v-bind:required="req" />
    <input v-if="checked" v-bind:value="value" type="checkbox" checked v-bind:class="css" data-color="#039cfd" data-plugin="switchery" v-bind:id="id" v-bind:name="name" v-bind:placeholder="placeholder" v-bind:required="req" />
</div>
</div>
</template>

<script>
    export default {
        props: ['css', 'label', 'id', 'name', 'value', 'size', 'checked'],
computed: {
 defineSize: function(){
    
        return "col-md-"+(this.size || 12);
}
}
        
      
    }
</script>
