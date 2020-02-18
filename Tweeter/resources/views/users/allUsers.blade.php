@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>All Users</h4></div>
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
                                        <br>
                                        <div>
                                            @if (checkFollowing($allUser->id, Auth::user()->follow))
                                                {{-- <p>Already Following</p> --}}
                                            <form action="/unfollow/{{$allUser->id}}" method="post">
                                                @csrf
                                            <input type="hidden" name="user_id" value = "{{$allUser->id}}">
                                                <input class="btn btn-warning rounded-pill" type="submit" value="Unfollow">
                                            </form>
                                            @else
                                                <form action="/following/{{$allUser->id}}" method="post">
                                                    @csrf
                                                    <input class="btn btn-success rounded-pill"type="submit" value="Follow">
                                                    <input type="hidden" name="followed" value = "{{$allUser->id}}">

                                                </form>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="button-lg">
                                            <a href="/profile/{{$allUser->id}}" class="btn btn-primary btn-block rounded-pill">Show Profile</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
