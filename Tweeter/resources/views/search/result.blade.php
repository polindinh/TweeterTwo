@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Search result for:  {{Request::get('search')}}</h4></div>
                    <div class="card-body">
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
                                    {{-- <img src="{{asset('/storage/'.$profile->profile_pic)}}" alt="Image"> --}}
                                        <div class="card-footer">
                                            <div class="profile-result">
                                                {{-- <img src="{{asset('/storage/'.$profile->profile_pic)}}" height="51px;"alt="Image"> --}}
                                            </div>
                                                <span>
                                                    <h4 class="card-title" style="margin-bottom:0;"><b>{{$searchUser->name}}</b></h4>
                                                </span>
                                            <br>
                                            <div>
                                                @if (checkFollowing($searchUser->id, Auth::user()->follow))
                                                <form action="/unfollow/{{$searchUser->id}}" method="post">
                                                    @csrf
                                                <input type="hidden" name="user_id" value = "{{$searchUser->id}}">
                                                    <input class="btn btn-warning" type="submit" value="Unfollow">
                                                </form>
                                                @else
                                                    <form action="/following/{{$searchUser->id}}" method="post">
                                                        @csrf
                                                        <input class="btn btn-success" type="submit" value="Follow">
                                                        <input type="hidden" name="followed" value = "{{$searchUser->id}}">

                                                    </form>
                                                @endif
                                            </div>
                                            <br>
                                            <div class="button-lg">
                                                <a href="/profile/{{$searchUser->id}}" class="btn btn-primary btn-block">Show Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                            @endforeach
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
