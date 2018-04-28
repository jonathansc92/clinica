<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\States;

class StatesController extends Controller {

    public function getStates(Request $request) {
        $states = States::where('countries_id', '=', $request->country)->get();
        return response()->json($states);
    }

  
}
