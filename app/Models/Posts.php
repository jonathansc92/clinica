<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Search;
use App\Models\Cities;
use App\Models\States;
use App\Models\Countries;
use App\Models\PostsCategory;

class Posts extends Model {

    protected $fillable = [
        'title',
        'content',
        'data',
        'active',
        'feature',
        'views',
        'tip',
        'imgdefault',
        'country_id',
        'city_id',
        'state_id'
    ];
    protected $table = 'posts';
    protected $primaryKey = 'id';

   public function __construct() {
        $this->setUpdatedAt(date('Y-m-d H:i:s'));
        $this->setCreatedAt(date('Y-m-d H:i:s'));
    }

    public function category() {
        return $this->hasMany('App\Models\PostsCategory');
    }
    
    public function country() {
        return $this->belongsTo(Countries::class);
//        return $this->belongsTo('App\Models\Countries');
    }
    
    public function city() {
        return $this->belongsTo(Cities::class);
    }
    
    public function state() {
        return $this->belongsTo(States::class);
//                return $this->belongsTo('App\Models\States');

    }
    
    public function comments(){
        return $this->hasMany(Comments::class);
    }

    public static function rules() {
        return [
            'title' => 'required',
            'content' => 'required',
            'imgdefault' => 'required',
        ];
    }

    static function postById($p) {
        return Posts::find($p);
    }

    static function postLst() {
        return Posts::where('active', 'S')->paginate(6);
    }

    static function getAllPost() {
        return Posts::all();
    }

    static function postFeatured($qtd) {
        $post = Posts::where('feature', 'S')
                ->where('active', 'S')
                ->take($qtd)->get();

        return $post;
    }

    static function postMoreViews($pQty) {
        $post = Posts::orderBy('views', 'desc')
                ->where('active', 'S')
                ->take($pQty)
                ->get();

        return $post;
    }

    static function postActually($pQty) {
        $post = Posts::orderBy('id', 'desc')
                        ->where('active', 'S')
                        ->take($pQty)->get();

        return $post;
    }

    static function search($p) {

        $search = new Search($p);
        $search->saveSearch();

        $posts = Posts::where('title', 'LIKE', "%$p%")->paginate(6);

        return $posts;
    }

    static function getTotalPost() {
        return Posts::getAllPost()->count();
    }

    static function saveView($p) {

        $post = Posts::find($p);
        $post->views = $post->views + 1;
        $post->save();
    }

}
