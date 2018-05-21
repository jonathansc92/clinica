@extends('layouts.app')
  
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">

    <div class="account-bg">
        <div class="card-box mb-0">
            <div class="text-center m-t-20">
                <a href="#" class="logo">
                    <img width='' height='' src='{{url('/images/logo.png')}}'/>
<!--                    <span> <img src="{{url('/images/logo_site.png')}}" /></span></a>-->
                </a>
            </div>
            <div class="m-t-10 p-20">
                <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-mail</label>

                        <div class="col-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Senha</label>

                        <div class="col-12">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                            @foreach($erros->all() as $error)
                            <span class="help-block">
                                <strong>{{ $error }}</strong>
                            </span>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <!--                    <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>-->

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">
                            Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        <script src="{{ asset('theme/uplon-admin/js/jquery.min.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function () {
//
    @if ($errors->has('email'))
        @foreach($errors as $error)

    toastr.warning({!!$error!!}, 'sas');
    @endforeach

    @endif

    });



</script>