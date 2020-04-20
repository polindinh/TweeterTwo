<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;
use \App\Like;

class LikesController extends Controller
{
    public function like($id){
        if(Auth::check()){
            $like = new \App\Like;
            $like->user_id = Auth::user()->id;
            $like->tweet_id = $id;
            $like->save();
            return back();

        }
        // return $id;
        // $loggedInUser = Auth::user()->id;
        // $likeUser = \App\Like::where(['user_id'=>$loggedInUser,'tweet_id'=> $id ]);
        // if(empty($likeUser ->user_id )){
        //     $user_id = Auth::user()->id;
        //     $tweet_id = $id;
        //     $like = new \App\Like;
        //     $like->user_id = $user_id;
        //     $like->tweet_id = $tweet_id;
        //     $like->save();
        //     return back();
        // }else{
        //     return Redirect::back();


    }

    public function unlike($id){
        Like::where('user_id', Auth::user()->id)
                ->where('tweet_id', $id)
                ->delete();
        return back();

    }
}
