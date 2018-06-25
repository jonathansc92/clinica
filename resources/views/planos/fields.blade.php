<div class='form-group'>
    {!!Form::label('descricao', 'Descrição', ['class'=>'required'])!!}
    {!! Form::text('descricao', isset($planos->descricao)?$planos->descricao:null, ['required'=>'required','class' => 'form-control']) !!}
</div>

<div class='form-group'>
    {!!Form::label('cnpj', 'CNPJ')!!}
    {!! Form::text('cnpj', isset($planos->cnpj)?$planos->cnpj:null, ['id'=>'cnpj','data-mask'=>'00.000.000/0000-00','class' => 'form-control cnpj']) !!}
</div>

<div class='form-group'>

    {!!Form::label('contato', 'Contato')!!}
    {!! Form::text('contato', isset($planos->contato)?$planos->contato:null, ['class' => 'form-control']) !!}

</div>


<div class="pull-right">
    <a href='/planos' class='btn btn-danger'> Cancelar</a>
    {!! Form::button('Salvar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  !!}
</div>

<script>

$(document).ready(function () {

$('.cnpj').on('blur', function () {
var cnpj = $("#" + this.id).val();

if (cnpj != "") {
if (isCNPJ(cnpj) == false) {
console.log('CNPJ inválido, preencha um CNPJ válido.');
toastr.error('CNPJ inválido, preencha um CNPJ válido.');
$( "input[name*='cnpj']" ).val("");
return false;
}
}
});

});
</script>