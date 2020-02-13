<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
class SearchController extends Controller
{
    public function search(Request $request){
        $searchInput = $request->input('search');
        // dd($searchInput);
        $searchUsers = User::where('name','Like','%'.$searchInput.'%')->get();
        // $profile = Profile::find()
        return view('search.result', compact('searchUsers'));

    }
}
