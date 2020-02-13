@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Search result for:  {{Request::get('search')}}</h4></div>
                    <div class="card-body">
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
                                                <div class="button-lg">
                                                <a href="/profile/{{$searchUser->id}}" class="btn btn-primary btn-block">Show Profile</a>
                                                </div>
                                            </div>
                                            <?php
                                            $notFollowing = App\Follow::where('followed','=',$searchUser->id)->first();
                                            if(is_null($notFollowing)){
                                        ?>
                                            <a href="{{route('sfollowing',$searchUser->id)}}" class="btn btn-success">Follow</a>
                                            {{-- <a href="/following/{{$searchUser->id}}" class="btn btn-success">Follow</a> --}}
                                        <?php
                                            }else {?>
                                                <a href="{{route('sunfollow',$searchUser->id)}}" class="btn btn-success">Unfollow</a>
                                                {{-- <a href="/unfollow/{{$searchUser->id}}" class="btn btn-success">Unfollow</a> --}}

                                           <?php } ?>
                                    </div>
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
