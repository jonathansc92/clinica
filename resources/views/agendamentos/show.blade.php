<p><b>Paciente:</b> {{$agendamentos->paciente->nome}}</p>
<p><b>Médico:</b> {{$agendamentos->medico->nome}}</p>
<p><b>Horário:</b> {{\Carbon\Carbon::parse($agendamentos->data_hora)->format('d/m/Y h:i')}}</p>

