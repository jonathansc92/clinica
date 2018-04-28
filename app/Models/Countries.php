<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;

class Countries extends Model {

    protected $fillable = [
        'name',
        'namept',
        'abbrev',
        'bacen'
    ];
    protected $table = 'countries';
    protected $primaryKey = 'id';

    public function posts() {
        return $this->hasMany(Posts::class);
    }

}
