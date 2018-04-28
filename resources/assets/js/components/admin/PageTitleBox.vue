<template>
    <div class="row">
        <div v-bind:class="defineSize">
            <div class="page-title-box">
                <h4 class="page-title float-left"><i v-bind:class='defineIcon'></i> {{ title }}</h4>
 
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="#">Geral</a></li>
                    <li class="breadcrumb-item active"> </li>
                </ol>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    props: ['size', 'title', 'icon'],
    computed: {

    defineSize: function(){
    	return "col-xl-"+this.size
    },

    defineIcon: function(){
        return "fa fa-"+this.icon
    }
    }
}
    
</script>
