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


class ProfilesController extends Controller
{
    public function showProfile($id){
        $profiles = \App\Profile::where('user_id','=',$id)->get();
        return view('profiles.profile', ['profiles'=> $profiles]);
    }

    public function updateProfile(Request $request){
            if($request->hasFile('profile_pic')){
                $profile = $request -> file('profile_pic');
                $fileName = time(). '.'.$profile->getClientOriginalExtension();
                $location = public_path('/storage/profile_images'.$fileName);

                Image::make($profile)->resize(300,300)->save($location);
                // $oldFile = $profile->profile_pic;
                $user = Auth::user();
                $user=  \App\User::find($request->id);
                $user -> profile_pic = $fileName;
                // Storage::delete($oldFile);

                $user ->save();
            }
            return view('profiles.profile', array('user'=> Auth::user()));


    }



}
