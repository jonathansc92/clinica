<link href="{{ asset('theme/uplon-admin/css/bootstrap.min.css') }}" rel="stylesheet">
<style>
     #noprint { display:none; } 
</style>
<div class='container'>

    <div class='col-md-12'>
        <div style='float: right'>
            <a href='#' class='btn btn-success' onClick="window.print()" id='noprint'><i class='fa fa-print'></i> Imprimir</a>
        </div>
        </div>

    <table cellpadding='0' cellspacing='0'>
        <tr>
            <!--<td><img width='100px' height='100px' src='{{url('/images/logo.png')}}'/></td>-->
            <td><h3>Relatório de {{Request::segment(1)}}</h3></td>
            <td></td>
        </tr>
    </table>


    <table class='table' id='' width='100%'>


        <tr>
            <th align='center'>Data</th>
            <th align='center'>Paciente</th>
            <th align='center'>Médico</th>
        </tr>

        @foreach($data as $agendamento)
        <tr>
            <td align='center'>{{\Carbon\Carbon::parse($agendamento->data)->format('d/m/Y')}}</td>
            <td align='center'>{{$agendamento->paciente->nome}}</td>
            <td align='center'>{{$agendamento->medico->nome}}</td>
        </tr>
        @endforeach

    </table>
</div>