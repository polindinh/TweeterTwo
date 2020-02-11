<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Profile;
use Auth;
use Image;
use App\User;
use Storage;
use Illuminate\Support\Facades\Redirect;


class ProfilesController extends Controller
{
    public function showProfile($id){
        $profiles = \App\Profile::where('user_id','=',$id)->get();
        return view('profiles.profile', ['profiles'=> $profiles]);
    }

    public function addProfile(Request $request){
            if($request->hasFile('profile_pic')){
                $validateData = $request->validate(['date_of_birth'=>'required',
                                                    'gender'=>'required',
                                                    'quote'=>'required',
                                                    'profile_pic'=>'required|image|max:5000',

                                            ]);

                $profiles = new \App\Profile;
                $profiles -> name = Auth::user()->name;
                $profiles -> user_id = Auth::user()->id;
                $profiles -> date_of_birth = $request->date_of_birth;
                $profiles -> gender = $request->gender;
                $profiles -> quote = $request->quote;
                $profiles -> profile_pic = $request->profile_pic->store('profile_images','public');
                $profiles -> save();
                $result = \App\Profile::all();

                return Redirect::route('home', ['profiles'=>$result])->with('success','Your profilke has been created successfully!');
            }
            return redirect('home');
    }
    public function updateProfile($id){
        $profiles = \App\Profile::where('user_id','=',$id)->get();
        return view('profiles.updateprofile', ['profiles'=> $profiles]);
    }


}
