<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cities;

class CitiesController extends Controller {

    public function getCities(Request $request) {
        
        //dd($request->state);
        $cities = Cities::where('state_id', '=', $request->state)->get();
        return response()->json($cities);
    }

}
