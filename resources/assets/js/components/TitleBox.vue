<template>

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 " >
        <div class="card-box tilebox-two effect3">
            <a v-bind:href="url" class="btn btn-sm btn-custom waves-effect waves-light float-right">Ver</a>
            <h6 class="text-muted text-uppercase m-b-15">{{title}}</h6>
            <h2 class="m-b-20"><span data-plugin="counterup">{{value}}</span></h2>
        </div>
    </div>

</template>

<script>
    export default {  
        props: ['title', 'value', 'url']
       
    }
</script>
