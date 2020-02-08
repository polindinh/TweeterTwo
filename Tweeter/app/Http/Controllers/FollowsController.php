<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Follow;
use App\User;


class FollowsController extends Controller
{

    function follow(){
        if(Auth::check()) {
            $users = \App\User::all();
            $follows = \App\Follow::where('user_id', Auth::user()->name)->get();
            return view('allUsers', ['users' => $users, 'follows' => $follows]);
        } else {
            return redirect('/home');
        }
    }
    // public function follows($username){

    //     // Find the User. Redirect if the User doesn't exist
    //     $user = User::where('username', $username)->firstOrFail();

    //     // Find logged in User
    //     $id = Auth::id();
    //     $me = User::find($id);
    //     $me->following()->attach($user->id);
    //     return redirect('/home/user/' . $username);

    //   }

    //   public function unfollows($username){

    //     // Find the User. Redirect if the User doesn't exist
    //     $user = User::where('username', $username)->firstOrFail();

    //     // Find logged in User
    //     $id = Auth::id();
    //     $me = User::find($id);
    //     $me->following()->detach($user->id);
    //     return redirect('/home/user/' . $username);

    //   }

}
