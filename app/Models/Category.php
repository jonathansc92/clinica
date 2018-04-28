<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $fillable = [
        'id',
        'description',
        'created_at',
        'updated_at'
    ];
    protected $table = 'category';
    protected $primaryKey = 'id';

    function __construct() {
        $this->setUpdatedAt(date('Y-m-d H:i:s'));
    }

    public function posts() {
        return $this->belongsToMany('App\Models\Posts', 'posts_category', 'category_id', 'posts_id');
    }

}
