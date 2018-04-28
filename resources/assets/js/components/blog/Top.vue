<template>
  <div id="house" class="top-header">
    <div class="col-md-6 logo-w3l w32">

        <h1 class="location"><span class="icon-w3"></span><a href="index.html">Viagem a três</a></h1>
    </div>
    <div class="col-md-6 logo-w3l w31 sea">
        <div class="right-w3l">
            <ul class="top-links">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-snapchat-ghost"></i></a></li>
                <li><a href="https://www.instagram.com/viagem_a_dois/" target='_blank'><i class="fa fa-instagram"></i></a></li>
    <!--<li><a href="#"><i class="fa fa-"></i></a></li>-->
<!--                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>-->
            </ul>
        </div>
        <div class="search">
            <form action="{{route('search')}}" method="post">
                {{ csrf_field() }}
                <input type="search" placeholder="Pesquisar..." name="search" required="">
                <input type="submit" value="">
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</template>

<script>
    export default {
    }
</script>
