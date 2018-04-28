<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;
use App\Models\Cities;
use App\Models\Posts;

class States extends Model {

    protected $fillable = [
        'name',
        'uf',
        'ibge',
        'sl',
        'ddd',
        'country_id'
       
    ];
    protected $table = 'states';
    protected $primaryKey = 'id';

    public function country() {
        return $this->belongsTo(Countries::class);
    }
    
    public function city() {
        return $this->hasMany(Cities::class);
    }
    
    public function posts() {
        return $this->hasMany(Posts::class);
    }
}
