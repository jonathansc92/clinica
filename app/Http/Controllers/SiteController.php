<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use App\Models\Search;
use App\Models\Countries;

class SiteController extends Controller {

    public function __construct() {
        $this->user = User::where('email', 'tamara@tripatres.com.br')->get();
        $this->moreviews = Posts::postMoreViews(4);
        $this->postactually = Posts::postActually(4);
    }

    public function index() {
        
//        dd(Countries::with('posts')->get());

        $var['user'] = $this->user;
        $var['postfeatured'] = Posts::postFeatured(1);
        $var['post'] = Posts::where('active', 'S')->paginate(6);
        $var['moreviews'] = $this->moreviews;
        $var['postfirstviews'] = Posts::postMoreViews(1);
        $var['postactually'] = $this->postactually;

        return view('site.index', compact('var'));
    }

    public function post(Request $request, $id) {
        $post = Posts::find($id);

        Posts::saveView($id);
        $var['user'] = $this->user;
        $var['moreviews'] = $this->moreviews;
        $var['post'] = $post;
        $var['postactually'] = $this->postactually;
        return view('site.post', compact('var'));
    }

    public function postlst(Request $request) {

        if ($request->segment(2) == 'pais') {
            $var['postlst'] = Posts::where('pais', $request->param)->get();
        }

        if ($request->segment(2) == 'cat') {
            $var['postlst'] = $this->getPostsByCategory($request->param);
        }

        if ($request->segment(1) == 'dicas') {
            $var['postlst'] = Posts::where('tip', 'S')->paginate(9);
        }

        if ($request->segment(2) == 'pesquisa') {
//            \Illuminate\Support\Facades\Session::put('term', $request->param);
            $var['postlst'] = $this->search($request->param);
        }

        return view('site.postlst', compact('var'));
    }

    protected function getPostsByCategory($category) {

        $posts = new \App\Models\PostsCategory();

        return $posts->with('posts')
                        ->with('category')
                        ->where('category_id', $category)
                        ->paginate(10);
    }

    protected function search($term) {

        Search::saveSearch($term);

        return Posts::where('title', 'like', $term . '%')->paginate(9);
    }

}
