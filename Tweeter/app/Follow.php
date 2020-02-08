<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follows';
    function user(){
        return $this->belongsTo('\App\User');
    }
}
