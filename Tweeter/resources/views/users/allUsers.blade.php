@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>All Users</h4></div>
                    <div class="card-body">
                            @foreach ($allUsers as $allUser)
                                <div class="col-md-4">
                                    <div class="box-card">
                                        {{-- <img src="{{asset('/storage/'.$profile->profile_pic)}}" alt="Image"> --}}
                                            <div class="card-footer">
                                                <div class="profile-result">
                                                    {{-- <img src="{{asset('/storage/'.$profile->profile_pic)}}" height="51px;"alt="Image"> --}}
                                                </div>
                                                <span>
                                                    <h4 class="card-title" style="margin-bottom:0;"><b>{{$allUser->name}}</b></h4>
                                                </span>
                                                <div class="button-lg">
                                                <a href="/profile/{{$allUser->id}}" class="btn btn-primary btn-block">Show Profile</a>
                                                </div>
                                            </div>
                                            <?php
                                                $notFollowing = App\Follow::where('followed','=',$allUser->id)->first();
                                                if(is_null($notFollowing)){
                                            ?>
                                                <a href="{{route('following',$allUser->id)}}" class="btn btn-success">Follow</a>
                                            <?php
                                                }else {?>
                                                    <a href="{{route('unfollow',$allUser->id)}}" class="btn btn-success">Unfollow</a>
                                               <?php } ?>
                                    </div>
                                </div>

                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


{{-- @extends('layouts.app')

@php
    function checkFollowing($userToCheck, $follows) {
        foreach ($follows as $follow) {
            if($follow->followed == $userToCheck) {
                return true;
            }
        }
        return false;
    }
@endphp

@section('content')
    @foreach ($users as $user)
        <p>{{$user->name}}</p>
        @if (checkFollowing($user->name, $follows))
            <p>Already Following!</p>
        @else
            <form action="/Profiles" method="post">
                @csrf
                <input type="submit" value="Follow">
            </form>
        @endif
    @endforeach
@endsection --}}
