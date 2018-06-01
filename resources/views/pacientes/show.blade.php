<p><b>Plano:</b> {{$pacientes->plano->descricao}}</p>
<p><b>Número de CPF:</b> {{$pacientes->cpf}}</p>
<p><b>Data de Nascimento:</b> {{Carbon\Carbon::parse($pacientes->d_nascimento)->format('d/m/Y')}}</p>