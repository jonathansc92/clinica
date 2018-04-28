<template>
<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card-box tilebox-one effect2">
                        <i class="fa fa-comments float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Comentários</h6>
                        <h2 class="m-b-20">{{tcomments}}<span data-plugin="counterup"> </span></h2>
                        <span class="label label-danger"> -29% </span> <span class="text-muted">From previous period</span>
                    </div>
                </div>
</template>

<script>
    export default {
props:['tcomments']
    }
</script>
