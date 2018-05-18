<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }
    public function index()
    {
        
        $var['qtdMedicos'] = \App\Models\Medicos::all()->count();
        $var['qtdPacientes'] = \App\Models\Pacientes::all()->count();
        $var['qtdPlanos'] = \App\Models\Planos::all()->count();
        $var['qtdEspecialidades'] = \App\Models\Especialidades::all()->count();
        
        return view('index')->with('var', $var);
    }
}
