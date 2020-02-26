<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Redirect;


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
    // function showFollowUser(Request $request){
    //     if(Auth::check()) {
    //         $users = \App\User::all();
    //         $follows = \App\Follow::where('user_id', Auth::user()->id)->get();
    //         return view('users.follows', ['users' => $users, 'follows' => $follows]);
    //     } else {
    //         return redirect('/home');
    //     }
    // }

}
