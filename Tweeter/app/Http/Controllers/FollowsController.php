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
    public function sfollowing($id){
        $follow = new Follow;
        $follow->user_id = Auth::user()->id;
        $follow->followed = $id;
        $follow->save();
        return back();
    }
    public function sunfollow($id){
        Follow::where('user_id', Auth::user()->id)
                    ->where('followed', $id)
                    ->delete();
        return back();
    }


    // public function follow($id){
    //     // return $id;
    //     $loggedInUser = Auth::user()->id;
    //     $followUser = \App\Follow::where(['user_id'=>$loggedInUser,'followed'=> $id ]);
    //     if(empty($followUser ->user_id )){
    //         $user_id = Auth::user()->id;
    //         $followed = $id;
    //         $follows = new \App\Follow;
    //         $follows->user_id = $user_id;
    //         $follows->followed = $followed;
    //         $follows->save();
    //         $follows = \App\Follow::find($id);
    //         return redirect('home');
    //     }else{
    //         return Redirect::back();

    //     }
    // }

    // public function unfollow($id){
    //        // return $id;
    //        $loggedInUser = Auth::user()->id;
    //        $followUser = \App\Follow::where(['user_id'=>$loggedInUser,'followed'=> $id ]);
    //        if(empty($followUser ->user_id )){
    //            $user_id = Auth::user()->id;
    //            $followed = $id;
    //            $follow = new \App\Follow;
    //            $follow->user_id = $user_id;
    //            $follow->followed = $followed;
    //            $follow->save();
    //            return redirect('home');
    //        }else{
    //            return Redirect::back();
    //        }

    // }
}
