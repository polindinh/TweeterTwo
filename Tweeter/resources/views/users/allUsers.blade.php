@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>All Users</h4></div>
                    <div class="card-body ">
                        <div class="row">
                            @php
                                function checkFollowing($userToCheck, $allUsers) {
                                foreach ($allUsers as $allUser) {
                                    if($allUser->followed == $userToCheck) {
                                    return true;
                                    }
                                }
                                    return false;
                                }


                            @endphp
                            @foreach ($allUsers as $allUser)
                            {{-- @php
                                $profileImage = \App\User::find($allUser->id)->profile;
                            @endphp --}}
                                <div class="col-md-4">
                                    <div class="box-card">
                                        <div class="card-footer">
                                            <div class="profile-result">
                                                {{-- <img class="img-fluid" src="{{asset('/storage/'.$profileImage->profile_pic)}}" style="border-radius:50%;height:100px;width:100px;" alt="Image"> --}}

                                                    <span>
                                                        <h4 class="card-title text-center" style="margin-bottom:0;"><b>{{$allUser->name}}</b></h4>
                                                    </span>
                                                    <hr>
                                                    <br>
                                                    @if (checkFollowing($allUser->id, Auth::user()->follow))
                                                        {{-- <p>Already Following</p> --}}
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
                                                <br>
                                                <div class="button-lg">
                                                    <a href="/profile/{{$allUser->id}}" class="btn btn-primary btn-block rounded-pill">Show Profile</a>
                                                </div>
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
        </div>
    </div>
</div>

@endsection
