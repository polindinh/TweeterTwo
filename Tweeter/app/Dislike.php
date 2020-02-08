<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    protected $table = 'dislikes';
    function tweet(){
        return $this->belongsTo('\App\Tweet');
    }
    function user(){
        return $this->belongsTo('\App\User');
    }
}
