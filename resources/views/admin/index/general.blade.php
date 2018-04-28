@extends('admin.layouts.app')

@section('content')    
<pagetitlebox size='12' title='Geral' icon='dashboard'></pagetitlebox>

<div class="row">
    <box title='Posts' value='{{$var['totalposts']}}' icon='fa fa-align-justify'></box>
    <box title='Comentários' value='Pendentes: {{$var['comments']}}' icon='fa fa-comments'></box>
    <!--<box title='Acessos hoje' value='1' icon='fa fa-signal'></box>-->
</div>

@endsection
