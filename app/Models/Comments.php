<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

    protected $fillable = [
        'name',
        'email',
        'body',
        'ip',
        'email',
        'view',
        'active',
        'posts_id',
        'comments_id',
        'created_at',
        'updated_at',
		'comments'
    ];
    protected $table = 'comments';
    protected $primaryKey = 'id';

   public function __construct() {
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
    
    public function post(){
        return $this->belongsTo(Posts::class, 'posts_id');
    }

}
