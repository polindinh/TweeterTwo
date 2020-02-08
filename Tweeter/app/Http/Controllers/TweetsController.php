<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Tweet;
use App\Like;

class TweetsController extends Controller
{

    function addTweet(Request $request){
        $validateInput = $request->validate(['content'=>'required|min:50|max:280']);
        $tweet = new \App\Tweet;
        $tweet->user_id= $request->user_id;
        $tweet->content = $request->content;
        $tweet->save();
        $result = \App\Tweet::all();
        return Redirect::route('home', ['tweets'=>$result])->with('success','Your tweet has been created successfully!');
    }
    function deleteTweet(Request $request){
            \App\Tweet::destroy($request->id);
            $result = \App\Tweet::all();
            return Redirect::route('home', ['tweets'=>$result])->with('success','Your tweet has been deleted successfully!');
        }


    function edit(Request $request){
        $tweets = \App\Tweet::find($request->id);
        return view('tweets.edit',['tweets' => $tweets]);

    }
    function view ($id) {
        $tweets = \App\Tweet::where('id','=',$id)->first();
        return view('tweets.tweet', ['tweets' => $tweets]);

    }
    public function editTweet(Request $request){
        $validateData = $request->validate(['content'=>'required|min:50|max:280']);
        $tweet = \App\Tweet::find($request->id);
        $tweet->user_id = $request->user_id;
        $tweet->content = $request->content;
        $tweet->save();
        $result = \App\Tweet::all();
        return Redirect::route('home', ['tweets'=>$result])->with('success','Your tweet has been updated successfully!');

    }

}



