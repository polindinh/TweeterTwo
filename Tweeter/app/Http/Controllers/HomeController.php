<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use DB;
use Auth;
use App\Tweet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tweets = \App\Tweet::orderBy('id', 'DESC')->get();
        $users = \App\User::all();
        $follows = \App\User::find(Auth::user()->id)->follow;
        return view('home',['tweets'=>$tweets,'users'=>$users, 'follows'=>$follows]);
    }
}
