@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        @include('layouts.leftbar')

        <div class="col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <strong>Following and Followers</strong>
                </div>
                    <div class="card-body">
                        <h3>Following</h3>
                        <div class="row">
                            @foreach ($followingUsers as $allUser)
                            @php
                                $profileImage = \App\User::find($allUser->id)->profile;
                            @endphp
                                <div class="col-md-4">
                                    <div class="box-card">
                                        <div class="card-footer">
                                            <div class="profile-result">
                                                <img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/'.$profileImage->profile_pic)}}" style="border-radius:50%;height:50px;width:50px;" alt="Image">
                                                <br>
                                                    <a href="/profile/{{$allUser->id}}"><h4 class="text-center" style="margin-bottom:0;"><b>{{$allUser->name}}</b></h4></a>
                                                    <hr>
                                                    <form class="text-center" action="/unfollow/{{$allUser->id}}" method="post">
                                                        @csrf
                                                    <input type="hidden" name="user_id" value = "{{$allUser->id}}">
                                                        <input class="btn btn-warning rounded-pill" type="submit" value="Unfollow">
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <h3>Followers</h3>
                        <div class="row">
                            @php
                                function checkFollowingI($userToCheck, $followers) {
                                foreach ($followers as $allUser) {
                                    if($allUser->followed == $userToCheck) {
                                    return true;
                                    }
                                }
                                    return false;
                                }
                            @endphp
                            @foreach ($followers as $allUser)
                            @php
                                $profileImage = \App\User::find($allUser->id)->profile;
                            @endphp
                                <div class="col-md-4">
                                    <div class="box-card">
                                        <div class="card-footer">
                                            <div class="profile-result">
                                                <img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/'.$profileImage->profile_pic)}}" style="border-radius:50%;height:50px;width:50px;" alt="Image">
                                                <br>
                                                <a href="/profile/{{$allUser->id}}"><h4 class="text-center" style="margin-bottom:0;"><b>{{$allUser->name}}</b></h4></a>
                                                <hr>
                                                @if (checkFollowingI($allUser->id, Auth::user()->follow))
                                                    <form class="text-center" action="/unfollow/{{$allUser->id}}" method="post">
                                                        @csrf
                                                    <input type="hidden" name="user_id" value = "{{$allUser->id}}">
                                                        <input class="btn btn-warning rounded-pill" type="submit" value="Unfollow">
                                                    </form>
                                                    @else
                                                        <form class="text-center" action="/following/{{$allUser->id}}" method="post">
                                                            @csrf
                                                            <input class="btn btn-success rounded-pill"type="submit" value="Follow">
                                                            <input type="hidden" name="followed" value = "{{$allUser->id}}">
                                                        </form>
                                                    @endif
                                            </div>
                                        </div>
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
