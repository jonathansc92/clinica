<template>
    <div v-bind:class="defineSize">

<div class='form-group'>
    <label v-bind:for="name" v-if="label">{{label}}</label>
    <textarea 
        v-if="value"
        v-bind:class="css" 
        v-bind:id="id" 
        v-bind:name="name" 
        v-bind:required="req" 
        v-bind:placeholder="placeholder"
       >{{value}}
    </textarea>    
    <textarea 
        v-if="!value"
        v-bind:class="css" 
        v-bind:id="id" 
        v-bind:name="name" 
        v-bind:required="req" >
    </textarea>    
</div>
</div>
</template>

<script>
    export default {
        props: ['css', 'label', 'id', 'name', 'req', 'placeholder', 'value', 'size'],
computed: {
 defineSize: function(){
    
        return "col-md-"+(this.size || 12);
}
}
    }
</script>
