
<div  class="row">
    @if($var['user']->img)
    <div class="thumbnail">
        <img width="200px" height="200px" src="{{url('images/perfil/', $var['user']->img)}}" />
    </div>
    @endif

    <input  type="file" name="img" />
    

</div>

<div class="row">
    <div class='col-md-6'>

        <div class='form-group'>
            {!!Form::label('name', 'Nome', ['class'=>'required'])!!}
            {!! Form::text('name', isset($var['user']->name)?$var['user']->name:null, ['required'=>'required','class' => 'form-control']) !!}

        </div>
    </div>

    <div class='col-md-6'>

        <div class='form-group'>
            {!!Form::label('email', 'Email', ['class'=>'required'])!!}
            {!! Form::text('email', isset($var['user']->email)?$var['user']->email:null, ['required'=>'required','class' => 'form-control']) !!}

        </div>
    </div>
</div>

<div class="row">
    <div class='col-md-6'>

        <div class='form-group'>
            {!!Form::label('password', 'Senha', ['class'=>'required'])!!}
            {!! Form::password('password', ['required'=>'required','class' => 'form-control']) !!}

        </div>
    </div>

    <div class='col-md-6'>

        <div class='form-group'>
            {!!Form::label('confirm_password', 'Confirmar Senha', ['class'=>'required'])!!}
            {!! Form::password('confirm_password', ['required'=>'required','class' => 'form-control']) !!}

        </div>
    </div>
</div>

<div class="pull-right">
    {!! Form::button('Salvar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  !!}
</div>