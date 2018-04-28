<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;
use App\Models\Category;

class PostsCategory extends Model {

    protected $fillable = [
        'id',
        'category_id',
        'posts_id',
        'created_at',
        'updated_at'
    ];
    protected $table = 'posts_category';
    protected $primaryKey = 'id';

    function __construct() {
        $this->setUpdatedAt(date('Y-m-d H:i:s'));
        $this->setCreatedAt(date('Y-m-d H:i:s'));
    }

    public static function trataSavePostsCategorias($categoryId, $postId) {

        $postcategory = new PostsCategory();
//        for ($i = 0; $i < count($categoryId); $i++) {
        $postCategory = $postcategory->where('posts_id', $postId)->where('category_id', $categoryId)->count();

        if ($postCategory == 0) {
            $postcategory->category_id = $categoryId;
            $postcategory->posts_id = $postId;
            $postcategory->saveOrFail();
        }
//        }
    }

    public static function deleteii($categoryId, $postId) {

        $postcategory = new PostsCategory();

        $p = $postcategory->where([['posts_id', '=', $postId]])->get();

        if ($p) {
            foreach ($p as $k) {
                if (!in_array($k->category_id, $categoryId)) {
                    $postcategory->find($k->id)->delete();
                }
            }
        }
    }

    public function posts() {
        return $this->belongsTo(Posts::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public static function del($id) {
        return PostsCategory::find($id)->delete();
    }

    public static function allLst() {
        return PostsCategory::with('posts')
                        ->with('category')
                        ->get();
    }

    public static function getPostByCategory($p) {
        return PostsCategory::where('category_id', $p)
                        ->with('posts')
                        ->with('category')
                        ->paginate(12);
    }

    static function saveRequest($pCat, $pPost) {

        $postcategory = new PostsCategory();
        $postcategory->category_id = $pCat;
        $postcategory->posts_id = $pPost;
        $postcategory->save();
    }

}
