$(document).ready(function () {

    $("#cities").hide();

    // AJAX STATES AND CITIES
    $.getJSON("/countries", function (json) {
        $('select[name=countries_id]').empty();
        $.each(json, function (key, value) {
            $('select[name=countries_id]').append('<option value=' + value.id + '>' + value.namept + '</option>');
        });
    });

    $('select[name=countries_id]').change(function () {
//                $("#loading").html("<img src='{{url('images/', 'loading.gif')}}'>");

        var countryId = $(this).val();
        $.get('/states/' + countryId, function (states) {
            if (states.length != 0) {
                $("#divCountry").show();
            }
            $('select[name=state]').empty();
            $.each(states, function (key, value) {
                $('select[name=state]').append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });
    });

    $('select[name=state]').change(function () {
        var stateId = $(this).val();
        $.get('/cities/' + stateId, function (cities) {
            if (cities.length != 0) {
                $("#divCity").show();
            }
            $('select[name=city]').empty();
            $.each(cities, function (key, value) {
                $('select[name=city]').append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });
    });
});