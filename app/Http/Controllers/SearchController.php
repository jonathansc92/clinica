<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index(){
        return view('admin.search.index');
    }

    public function report($start, $end)
    {
        $var['result'] = Search::whereBetween('created_at',[$start,$end])->get();

        return view('admin.search.result', compact('var'));

    }

}
