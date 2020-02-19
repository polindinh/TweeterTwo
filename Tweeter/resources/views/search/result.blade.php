@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Search result for:  {{Request::get('search')}}</h4></div>
                    <div class="card-body">
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
                            @if(count($searchUsers)>0)
                                @foreach ($searchUsers as $searchUser)
                                    <div class="col-md-4">
                                        <div class="box-card">
                                            <div class="card-footer">
                                                <div class="profile-result">
                                                    <span>
                                                        <h4 class="card-title text-center" style="margin-bottom:0;"><b>{{$searchUser->name}}</b></h4>
                                                    </span>
                                                    <hr>
                                                    <br>
                                                    @if($searchUser->id !== Auth::user()->id)
                                                        @if (checkFollowing($searchUser->id, Auth::user()->follow))
                                                            <form class="text-center" action="/unfollow/{{$searchUser->id}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value = "{{$searchUser->id}}">
                                                                <input class="btn btn-warning rounded-pill text-center" type="submit" value="Unfollow">
                                                            </form>
                                                        @else
                                                            <form class="text-center" action="/following/{{$searchUser->id}}" method="post">
                                                                @csrf
                                                                <input class="btn btn-success rounded-pill text-center" type="submit" value="Follow">
                                                                <input type="hidden" name="followed" value = "{{$searchUser->id}}">
                                                            </form>
                                                        @endif
                                                    @else
                                                        <p class="text-center">Your Profile</p>
                                                    @endif
                                                    <br>
                                                    <div class="button-lg">
                                                        <a href="/profile/{{$searchUser->id}}" class="btn btn-primary btn-block rounded-pill">Show Profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @else
                                No user found!
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
