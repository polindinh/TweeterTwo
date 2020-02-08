<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;


class UsersController extends Controller
{
    function showAllUsers() {
        if(Auth::check()) {
            $users = \App\User::all();
            $follows = \App\Follow::where('user_id', Auth::user()->name)->get();
            return view('users.allUsers', ['users' => $users, 'follows' => $follows]);
        } else {
            return redirect('/home');
        }

    }
}
