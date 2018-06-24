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
            <td><img width='' height='' src='{{url('/images/logo.png')}}'/></td>
            <td align='center'><h3>Relatório de {{Request::segment(1)}}</h3></td>
            <td></td>
        </tr>
    </table>


    <table class='table' id='' width='100%'>


        <tr align='center'>
            <th align='center'>Data</th>
            <th align='center'>Paciente</th>
            <th align='center'>Médico</th>            
        </tr>

        @foreach($data as $agendamento)
        <tr>
            <td>{{\Carbon\Carbon::parse($agendamento->data_hora)->format('d/m/Y')}}</td>
            <td>{{$agendamento->paciente->nome}}</td>
            <td>{{$agendamento->medico->nome}}</td>
        </tr>
        @endforeach

    </table>


</div>

<div style="position:fixed; bottom:100px; margin-left:80%; " class='pull-rigth'>
    <a href='/agendamentos/download/{{str_replace('/', '-',Request::get('data_inicial'))}}/{{str_replace('/', '-',Request::get('data_final'))}}' class="btn btn-success"><i class='fa fa-print'></i> Baixar Relatório </a>
</div>