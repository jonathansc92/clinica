<template>
    <div v-bind:id="id" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();">
            <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="custom-modal-title"><span v-bind:class='icon'></span> {{title}}</h4>
        <div class="custom-modal-text">
            <slot></slot>
        </div>
    </div>   
</template>

<script>
    export default {
        props: ['id', 'title', 'icon']
        
    }
</script>
