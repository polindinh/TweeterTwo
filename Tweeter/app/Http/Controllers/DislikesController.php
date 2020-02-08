<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;

class DislikesController extends Controller
{
    public function dislike($id){
        // return $id;
        $loggedInUser = Auth::user()->id;
        $dislikeUser = \App\Dislike::where(['user_id'=>$loggedInUser,'tweet_id'=> $id ]);
        if(empty($dislikeUser ->user_id )){
            $user_id = Auth::user()->id;
            $tweet_id = $id;
            $dislike = new \App\Dislike;
            $dislike->user_id = $user_id;
            $dislike->tweet_id = $tweet_id;
            $dislike->save();
            return redirect('home');
            // $likeCount = \App\Like::where('tweet_id','=', $id)->count();
            // $result = \App\Tweet::all();

        }else{
            return Redirect::back();

        }
    }
}
