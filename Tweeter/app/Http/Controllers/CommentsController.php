<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Comment;
use App\Tweet;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller

{

    function edit(Request $request){
        $tweets = \App\Tweet::find($request->id);
        $comments = \App\Comment::where('tweet_id', '=', $request->id)->orderBy('id', 'DESC')->get();
        return view('comments',['tweets' => $tweets, 'comments'=>$comments]);
    }
    public function commentPost (Request $request){
        $validateData = $request->validate(['content'=>'required|min:5|max:280']);
        $comments = new \App\Comment;
        $comments->user_id = Auth::user()->id;
        $comments->tweet_id = $request->tweet_id;
        $comments->content = $request->content;
        $comments->save();
        $result = \App\Comment::all();
        return redirect('/comment/'.$request->tweet_id)->with('success','Your comment has been created successfully!');
    }
    function view ($id) {
        $comments = \App\Comment::where('id','=',$id)->first();
        return view('commentView', ['comments' => $comments]);

    }
    public function editComment(Request $request){
        $validateData = $request->validate(['content'=>'required|min:5|max:280']);
        $comments = \App\Comment::find($request->id);
        $comments->user_id = $request->user_id;
        $comments->content = $request->content;
        $comments->save();
        $result = \App\Comment::all();
        return redirect('/comment/'.$comments->tweet_id)->with('success','Your comment has been updated successfully!');

    }

    function deleteComment($id){
        $result = \App\Comment::find($id);
        $result->delete();
        return Redirect::back()->with('success','Your comment has been deleted successfully!');
    }


}
