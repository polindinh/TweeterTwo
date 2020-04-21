@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.leftbar')

        <div class="col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header"><strong>Profile</strong></div>
                    <div class="card-body">
                        @include('flashMessage')
                        @php
                            function checkFollowingI($userToCheck, $users) {
                            foreach ($users as $user) {
                                if($user->followed == $userToCheck) {
                                return true;
                                }
                            }
                                return false;
                            }
                            function checkLike($tweetToCheck, $users){
                            foreach ($users as $user) {
                            if($user->tweet_id == $tweetToCheck) {
                            return true;
                            }
                        }
                            return false;
                        }
                        @endphp
                        @isset($profiles)
                                @if ( Auth::user()->id == $profiles->user_id )
                                        <div>
                                            <img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/'.$profiles->profile_pic)}}"style="border-radius:50%;height:150px;width:150px;" alt="Image">
                                            <br>
                                            <br>
                                            <h2>{{$profiles->name}}</h2>
                                            <b>Gender :</b> {{$profiles->gender}} <br>
                                            <b>Date of Birth : </b>{{$profiles->date_of_birth}}<br>
                                            <b>Inspiring Quote : </b>{{$profiles->quote}}<br>
                                            <b>Member Since :</b> {{date("jS F, Y",strtotime($profiles->created_at))}}


                                        </div>
                                        <div>
                                            @php
                                                $followingCount = count(\App\Follow::where('user_id','=', $profiles->user_id)->get());
                                                $followersCount = count(\App\Follow::where('followed','=', $profiles->user_id)->get());
                                                $tweetlinks = \App\Tweet::orderBy('id', 'DESC')->simplePaginate(3);


                                            @endphp
                                            <hr>
                                            <div>
                                                <a href="/follows/{{Auth::user()->id}}"><h4 class="text-center" style="color:#1DA1F2; display:inline-block;margin-right:10px;">Following ({{$followingCount}}) </h4></a>
                                                <a href="/follows/{{Auth::user()->id}}"><h4 class="text-center" style="color:#1DA1F2;display:inline-block;">Followers ({{$followersCount}}) </h4></a>
                                            </div>
                                            <br>


                                        </div>
                                        <form action="/updateProfileForm/{{$profiles->id}}" method="POST" style="display:inline-block">
                                            @csrf
                                            <input type="hidden" name="user_id" value={{Auth::user()->id}} class="btn btn-bg btn-primary">
                                            <input type="hidden" name="id" value={{$profiles->id}} class="btn btn-bg btn-primary">
                                            <input type="submit" value="Edit Profile"  class="btn btn-bg btn-primary rounded-pill">
                                        </form>
                                        <form action="/deleteProfileConfirm/{{$profiles->id}}" method="POST" style="display:inline-block">
                                            @csrf
                                            <input type="hidden" name="user_id" value={{Auth::user()->id}} class="btn btn-bg btn-primary">
                                            <input type="hidden" name="id" value={{$profiles->id}} class="btn btn-bg btn-primary">
                                            <input type="submit" value="Delete Profile"  class="btn btn-bg btn-primary rounded-pill">
                                        </form>

                                        <form action="/deleteUserConfirm/{{Auth::user()->id}}" method="POST" style="display:inline-block">
                                            @csrf
                                            <input type="hidden" name="id" value={{Auth::user()->id}} class="btn btn-bg btn-primary">
                                            <input type="submit" value="Delete Account"  class="btn btn-bg btn-danger rounded-pill">
                                        </form>
                                    @else
                                        <div>
                                            <img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/'.$profiles->profile_pic)}}" style="border-radius:50%;height:150px;width:150px;" alt="Image">
                                            <br>
                                            <br>
                                            <h2>{{$profiles->name}}</h2>
                                            {{-- <b>Gender :</b> {{$profiles->gender}} <br> --}}
                                            {{-- <b>Date of Birth : </b>{{$profiles->date_of_birth}}<br> --}}
                                            <b>Inspiring Quote : </b>{{$profiles->quote}}<br>
                                            <b>Member Since :</b> {{date("jS F, Y",strtotime($profiles->created_at))}}
                                            @php
                                                $followingCount = count(\App\Follow::where('user_id','=', $profiles->user_id)->get());
                                                $followersCount = count(\App\Follow::where('followed','=', $profiles->user_id)->get());
                                            @endphp
                                                <hr>
                                                <div>
                                                    <span>Following ({{$followingCount}}) </span>
                                                    <span>Followers ({{$followersCount}}) </span>
                                                    {{-- <a href="/follows/{{Auth::user()->id}}"><h4 class="text-center" style="color:#1DA1F2; display:inline-block;margin-right:10px;">Following ({{$followingCount}}) </h4></a>
                                                    <a href="/follows/{{Auth::user()->id}}"><h4 class="text-center" style="color:#1DA1F2;display:inline-block;">Followers ({{$followersCount}}) </h4></a> --}}
                                                </div>
                                                 <br>

                                                @if (checkFollowingI($users->id, Auth::user()->follow))
                                                <form action="/unfollow/{{$users->id}}" method="post">
                                                    @csrf
                                                <input type="hidden" name="user_id" value = "{{$users->id}}">
                                                    <input class="btn btn-warning rounded-pill" type="submit" value="Unfollow">
                                                </form>
                                                @else
                                                    <form action="/following/{{$users->id}}" method="post">
                                                        @csrf
                                                        <input class="btn btn-success rounded-pill"type="submit" value="Follow">
                                                        <input type="hidden" name="followed" value = "{{$users->id}}">
                                                    </form>
                                                @endif

                                        </div>
                                    @endif
                        @endisset
                        @empty($profiles)
                            <p>This user has not set up a profile yet!</p>
                        @endempty

                        <hr>
                        <h3>Recent Tweets </h3>
                        <hr>
                        @if (count($tweets)>0)
                                @foreach ($tweets as $tweet)
                                    @php
                                        $likeCount = count(\App\Tweet::find($tweet->id)->like);
                                        // $dislikeCount = count(\App\Tweet::find($tweet->id)->dislike);

                                    @endphp
                                    @if ($tweet-> user_id == Auth::user()->id)
                                    <a href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet-> user->name}}</strong></p></a>
                                    <p>{{substr($tweet-> content,0,150)}}</p>
                                        <p class = "time"><i>Posted: {{$tweet-> created_at->diffForHumans()}}</i></p>
                                        <p class = "time"><i>Updated: {{$tweet-> updated_at->diffForHumans()}}</i></p>

                                        @include('navbarUser')
                                        <br>
                                        @if (checkLike($tweet->id, Auth::user()->like))
                                            <form action="/unlike/{{$tweet->id}}" method="post">
                                                @csrf
                                            <input type="hidden" name="user_id" value = "{{$tweet->user_id}}">
                                                <input class="btn btn-warning rounded-pill" type="submit" value="Unlike">
                                            </form>
                                            @else
                                                <form action="/like/{{$tweet->id}}" method="post">
                                                    @csrf
                                                    <input class="btn btn-success rounded-pill"type="submit" value="Like">
                                                    <input type="hidden" name="user_id" value = "{{$tweet->user_id}}">

                                                </form>
                                            @endif
                                        <br>
                                        <hr>
                                    @else
                                        <a href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet-> user->name}}</strong></p></a>
                                        <p>{{substr($tweet-> content,0,150)}}</p>
                                        <p class = "time"><i>Posted: {{$tweet-> created_at->diffForHumans()}}</i></p>
                                        <p class = "time"><i>Updated: {{$tweet-> updated_at->diffForHumans()}}</i></p>

                                        @include('navbarGuest')
                                        <br>

                                        @if (checkLike($tweet->id, Auth::user()->like))
                                            <form action="/unlike/{{$tweet->id}}" method="post">
                                                @csrf
                                            <input type="hidden" name="user_id" value = "{{$tweet->user_id}}">
                                                <input class="btn btn-warning rounded-pill" type="submit" value="Unlike">
                                            </form>
                                            @else
                                                <form action="/like/{{$tweet->id}}" method="post">
                                                    @csrf
                                                    <input class="btn btn-success rounded-pill"type="submit" value="Like">
                                                    <input type="hidden" name="user_id" value = "{{$tweet->user_id}}">

                                                </form>
                                            @endif
                                        <hr>
                                    @endif
                                @endforeach
                            @else
                                <p>No tweet found!</p>
                            @endif

                            <div class="text-center">
                                {{ $tweetlinks->links()}}
                            </div>
                    </div>
                </div>
            </div>
        @include('layouts.rightbar')

    </div>
</div>


@endsection




