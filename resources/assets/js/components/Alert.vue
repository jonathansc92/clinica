<template>

<div id="alert" v-bind:class="defineAlert" class="alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{msg}}</strong> <slot></slot>
</div>
</template>

<script>
    export default { 
        props: ['type', 'msg'],
        computed: {
            defineAlert: function(){
                return "alert alert-"+(this.type || "success");
            }
        }
    }
$( document ).ready(function() {
setTimeout(function(){
  $('#alert').fadeIn();
}, 3*1000)
});
</script>
