@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        @include('layouts.leftbar')

        <div class="col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <strong>All Users</strong>
                </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                function checkFollowingI($userToCheck, $users) {
                                foreach ($users as $user) {
                                    if($user->followed == $userToCheck) {
                                    return true;
                                    }
                                }
                                    return false;
                                }
                            @endphp
                            @foreach ($users as $user)
                            @php
                                $profileImage = \App\User::find($user->id)->profile;
                            @endphp
                                <div class="col-md-4">
                                    <div class="box-card">
                                        <div class="card-footer">
                                            <div class="profile-result">
                                                <img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/'.$profileImage->profile_pic)}}" style="border-radius:50%;height:50px;width:50px;" alt="Image">
                                                <br>
                                                    <a href="/profile/{{$user->id}}"><h4 class="text-center" style="margin-bottom:0;"><b>{{$user->name}}</b></h4></a>
                                                    <hr>
                                                    @if (checkFollowingI($user->id, Auth::user()->follow))
                                                    <form class="text-center" action="/unfollow/{{$user->id}}" method="post">
                                                        @csrf
                                                    <input type="hidden" name="user_id" value = "{{$user->id}}">
                                                        <input class="btn btn-warning rounded-pill" type="submit" value="Unfollow">
                                                    </form>
                                                    @else
                                                        <form class="text-center" action="/following/{{$user->id}}" method="post">
                                                            @csrf
                                                            <input class="btn btn-success rounded-pill"type="submit" value="Follow">
                                                            <input type="hidden" name="followed" value = "{{$user->id}}">
                                                        </form>
                                                    @endif

                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @include('layouts.rightbar')

    </div>
</div>

@endsection




