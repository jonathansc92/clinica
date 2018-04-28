<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model {

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'description',
        'ip'
    ];
    protected $table = 'search';
    protected $primaryKey = 'id';

    function __construct() {
        $this->setUpdatedAt(date('Y-m-d H:i:s'));
        $this->setCreatedAt(date('Y-m-d H:i:s'));
        $this->setIp($_SERVER["REMOTE_ADDR"]);
    }

    function getIp() {
        return $this->ip;
    }

    function setIp($p) {
        $this->ip = $p;
    }

    public static function saveSearch($term) {
        $search = new Search();
        $search->description = $term;
        $search->save();
    }

}
