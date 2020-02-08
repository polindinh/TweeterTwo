<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;

class LikesController extends Controller
{
    public function like($id){
        // return $id;
        $loggedInUser = Auth::user()->id;
        $likeUser = \App\Like::where(['user_id'=>$loggedInUser,'tweet_id'=> $id ]);
        if(empty($likeUser ->user_id )){
            $user_id = Auth::user()->id;
            $tweet_id = $id;
            $like = new \App\Like;
            $like->user_id = $user_id;
            $like->tweet_id = $tweet_id;
            $like->save();
            return redirect('home');
            // $likeCount = \App\Like::where('tweet_id','=', $id)->count();
            // $result = \App\Tweet::all();

            // return view('home', ['tweets'=>$result])->with('likeCount', $likeCount);


            // return redirect('/view/{$id}');
        }else{
            // return redirect('/view/{$id}');
            return Redirect::back();

        }
    }
}
