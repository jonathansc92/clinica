@extends('layouts.app')
@section('content') 

<pagetitlebox size='12' title="" icon=""></pagetitlebox>

<div class="row">
    <title-box url='/medicos' title='Medicos' value='{{$var['qtdMedicos']}}'></title-box>
    <title-box url='/pacientes' title='Pacientes' value='{{$var['qtdPacientes']}}'></title-box>
    <title-box url='/planos' title='Planos' value='{{$var['qtdPlanos']}}'></title-box>
    <title-box url='/especialidades' title='Especialidades' value='{{$var['qtdEspecialidades']}}'></title-box>
</div>

@endsection