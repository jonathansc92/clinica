$(document).ready(function () {


    // AJAX STATES AND CITIES
    $.getJSON("/estoque/public/estados", function (json) {
        $('select[name=states]').empty();
        $.each(json, function (key, value) {
            $('select[name=states]').append('<option value=' + value.id + '>' + value.estado + '</option>');
        });
    });


    $('select[name=states]').change(function () {
        var idEstado = $(this).val();
        $.get('/estoque/public/cidades/' + idEstado, function (cidades) {
            $('select[name=cities]').empty();
            $.each(cidades, function (key, value) {
                $('select[name=cities]').append('<option value=' + value.id + '>' + value.cidade + '</option>');
            });
        });
    });

    // ---- //


   // $('select[id]').select2();
});

//$(document).ready(function () {
//    $('select[id]').select2();
//})