<template>
    <button v-bind:class="css"><span v-if="icon" v-bind:class="icon"></span> {{title}}</button>
</template>

<script>
    export default {
        props: ['title', 'css', 'icon']
    }
</script>
