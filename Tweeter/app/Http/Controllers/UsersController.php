<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Redirect;
use \App\Follow;


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
    function deleteUser(Request $request){
        $user = \App\User::find($request->id);
        if($user->id == Auth::user()->id){
            $user->comment()->delete();
            $user->tweet()->delete();
            $user->like()->delete();
            $user->follow()->delete();
            $user->profile()->delete();
            \App\User::destroy($request->id);
            return Redirect::route('home');
        }else{
            return Redirect::route('home')->with('warning', 'You can only delete your own profile');
        }
    }
    function deleteUserConfirm(Request $request){
        $user = \App\User::find($request->id);
        return view('users.confirm',['user'=>$user]);

    }

    public function showFollowUser(Request $request){
        if(Auth::check()){
            // $followingUsers = \App\User::whereIn('id', \App\Follow::select('followed')->where('user_id', Auth::user()->id)->get())->get();
            // $followers = \App\User::whereIn('id', \App\Follow::select('user_id')->where('followed', Auth::user()->id)->get())->get();
            $followingUsers = \App\User::whereIn('id', \App\Follow::select('followed')->where('user_id', $request->id)->get())->get();
            $followers = \App\User::whereIn('id', \App\Follow::select('user_id')->where('followed', $request->id)->get())->get();
            return view('users.follows', compact('followingUsers','followers'));
        }else{
            return redirect('/home');
        }
   }



}
