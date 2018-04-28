<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\States;

class Cities extends Model {

    protected $fillable = [
        'name',
        'state_id',
        'ibge'
    ];
    protected $table = 'cities';
    protected $primaryKey = 'id';

    public function states() {
        return $this->belongsTo(States::class);
    }

}
