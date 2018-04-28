@extends('admin/layouts/app')


@section('content') 

<pagetitlebox size='12' title="Comentário" icon="fa fa-comment"></pagetitlebox>
@include('flash::message')

<div class="row">
    <div class="col-12">
        <div class="timeline">
            <article class="timeline-item alt">
                <div class="text-right">
                    <div class="time-show first">
                        <a href="#" class="btn btn-custom w-lg">{{$var['comment'][0]['post']['title']}}</a>
                    </div>
                </div>
            </article>
            <article class="timeline-item alt">
                <div class="timeline-desk">
                    <div class="panel">
                        <div class="timeline-box">
                            <span class="arrow-alt"></span>
                            <span class="timeline-icon bg-danger"><i class="zmdi zmdi-circle"></i></span>
                            <h4 class="text-danger">{{$var['comment'][0]->name}}</h4>
                            <p class="timeline-date text-muted"><small>{{$var['comment'][0]->created_at->format('d/m/Y H:i:s')}}</small></p>

                            <p>{{$var['comment'][0]->body}} </p>
                        </div>
                    </div>
                </div>
            </article>
            @if(count($var['commentsLst']) > 0)
            @foreach($var['commentsLst'] as $comment)
            <article class="timeline-item ">
                <div class="timeline-desk">
                    <div class="panel">
                        <div class="timeline-box">
                            <span class="arrow"></span>
                            <span class="timeline-icon bg-success"><i class="zmdi zmdi-circle"></i></span>
                            <h4 class="text-success">{{$comment['name']}}</h4>
                            <p class="timeline-date text-muted"><small>{{$comment->created_at->format('d/m/Y H:i:s')}}</small></p>
                            <p>{!!$comment['body']!!}</p>

                        </div>
                    </div>
                </div>
            </article>
            @endforeach
            @endif
        </div>
    </div>
</div>
@if(count($var['commentsLst']) == 0)
<div class='row-12'>
    <form action="/comments/save" method="post" token="{{csrf_token()}}">

        <input type="hidden" name='_token' id="_token" value="{{ csrf_token() }}">

        <input type='hidden' value='{{$var['comment'][0]['id']}}' name='comments_id' />
        <input type='hidden' value='{{$var['comment'][0]['posts_id']}}' name='posts_id' />
        <input type='hidden' value='{{$var['comment'][0]['email']}}' name='EmailDestiny' />
        <input type='hidden' value='{{$var['comment'][0]['name']}}' name='NameDestiny' />
        <div class='form-group'>

            <textarea name='body' placeholder="comentar"></textarea>
        </div>
        <button class='btn btn-success'><i class='fa fa-send'></i> Enviar Mensagem</button>
    </form>
</div>
@endif



@endsection