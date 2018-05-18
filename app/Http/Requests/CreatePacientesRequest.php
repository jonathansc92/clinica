<?php

namespace App\Http\Requests;

use App\Models\Pacientes;
//use App\Http\Requests\Request;
use Illuminate\Http\Request;

class CreatePacientesRequest extends Request{

    public function authorize() {
        return true;
    }

    public function rules() {
        Pacientes::$rules();
    }

}
