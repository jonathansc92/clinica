<template>
    <div v-bind:class="defineSize">

<div class='form-group'>
        <label v-bind:for="name" v-if="label">{{label}}</label>

        <input v-if="value" v-bind:value="value" v-bind:type="type" v-bind:class="css" id="datepicker-autoclose" v-bind:name="name" v-bind:placeholder="placeholder" v-bind:required="req" />
        <input v-if="!value" v-bind:type="type" v-bind:class="css"  id="datepicker-autoclose" v-bind:name="name" v-bind:placeholder="placeholder" v-bind:required="req" />
    </div>
</div>
</template>

<script>
    export default {
        props: ['type', 'css', 'label', 'id', 'name', 'req', 'placeholder', 'value', 'size'],
        computed: {
            defineSize: function(){
                return "col-md-"+(this.size || 12);
            }
        }
    }
</script>
