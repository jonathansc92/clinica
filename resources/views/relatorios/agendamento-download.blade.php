<h1>Relatório de Agendamentos</h1>

<table class='table' id='' width='100%'>

    <tr align='center'>
        <th align='center'>Data</th>
        <th align='center'>Paciente</th>
        <th align='center'>Médico</th>

    </tr>

    @foreach($data as $agendamento)
    <tr>
        <td>{{\Carbon\Carbon::parse($agendamento->data)->format('d/m/Y')}}</td>
        <td>{{$agendamento->paciente->nome}}</td>
        <td>{{$agendamento->medico->nome}}</td>
    </tr>
    @endforeach

</table>