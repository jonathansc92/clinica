<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Posts;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $var['totalposts'] = Posts::getTotalPost();
        $var['comments'] = \App\Models\Comments::where('view', 'N')->count();
        
        return view('admin.index.general', compact('var'));
    }
}
