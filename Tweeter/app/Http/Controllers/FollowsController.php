<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Follow;
use App\User;


class FollowsController extends Controller
{
    public function allUsers(){
        $allUsers = User::where('id','!=',Auth::user()->id)->get();
        return view('users.allUsers', compact('allUsers'));
    }

    public function following($id){
        $follow = new Follow;
        $follow->user_id = Auth::user()->id;
        $follow->followed = $id;
        $follow->save();
        return back();
    }
    public function unfollow($id){
        Follow::where('user_id', Auth::user()->id)
                    ->where('followed', $id)
                    ->delete();
        return back();
    }
}
