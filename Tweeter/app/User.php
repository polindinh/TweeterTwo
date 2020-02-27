<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    function tweet(){
        return $this->hasMany('\App\Tweet');
    }
    function follow(){
        return $this->hasMany('\App\Follow');
    }

    function like(){
        return $this->hasMany('\App\Like');
    }
    function profile (){
        return $this->hasOne('\App\Profile');
    }
    function comment(){
        return $this->hasMany('\App\Comment');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
