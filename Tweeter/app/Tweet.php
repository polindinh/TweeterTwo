<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tweet extends Model
{
    protected $table = 'tweets';
    function user(){
        return $this->belongsTo('\App\User');
    }

    function comment(){
        return $this->hasMany('\App\Comment');
    }

    function like(){
        return $this->hasMany('\App\Like');
    }
    function dislike(){
        return $this->hasMany('\App\Dislike');
    }

}
