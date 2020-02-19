
@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                    <div class="card-body">
                        @include('flashMessage')
                        @php
                        function checkLike($tweetToCheck, $users){
                            foreach ($users as $user) {
                            if($user->tweet_id == $tweetToCheck) {
                            return true;
                            }
                        }
                            return false;
                        }
                        @endphp
                        @if (count($profiles)>0)
                            @foreach ($profiles as $profile)
                                <div>
                                    <img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/'.$profile->profile_pic)}}" style="border-radius:50%" alt="Image">
                                    <br>
                                    <br>
                                    <h2>{{$profile->name}}</h2>
                                    <b>Gender :</b> {{$profile->gender}} <br>
                                    <b>Date of Birth : </b>{{$profile->date_of_birth}}<br>
                                    <b>Inspiring Quote : </b>{{$profile->quote}}<br>
                                    <b>Member Since :</b> {{date("jS F, Y",strtotime($profile->created_at))}}
                                </div>

                                <div>
                                    @php
                                        $followingCount = count(\App\Follow::where('user_id','=', $profile->user_id)->get());
                                        $followersCount = count(\App\Follow::where('followed','=', $profile->user_id)->get());

                                    @endphp
                                    <hr>
                                    <div>
                                        <span style="color:#1DA1F2">Following ({{$followingCount}}) </span>
                                        <span style="color:#1DA1F2">Followers ({{$followersCount}}) </span>
                                    </div>
                                    <br>

                                <form action="/updateProfileForm/{{$profile->id}}" method="POST" style="display:inline-block">
                                    @csrf
                                    <input type="hidden" name="user_id" value={{Auth::user()->id}} class="btn btn-bg btn-primary">
                                    <input type="hidden" name="id" value={{$profile->id}} class="btn btn-bg btn-primary">
                                    <input type="submit" value="Edit Profile"  class="btn btn-bg btn-primary rounded-pill">
                                </form>

                                    <form action="/deleteProfileConfirm/{{$profile->id}}" method="POST" style="display:inline-block">
                                        @csrf
                                        <input type="hidden" name="user_id" value={{Auth::user()->id}} class="btn btn-bg btn-primary">
                                        <input type="hidden" name="id" value={{$profile->id}} class="btn btn-bg btn-primary">
                                        <input type="submit" value="Delete Profile"  class="btn btn-bg btn-primary rounded-pill">
                                    </form>
                                    <form action="/deleteUserConfirm/{{Auth::user()->id}}" method="POST" style="display:inline-block">
                                        @csrf
                                        <input type="hidden" name="id" value={{Auth::user()->id}} class="btn btn-bg btn-primary">
                                        <input type="submit" value="Delete Account"  class="btn btn-bg btn-danger rounded-pill">
                                    </form>
                                <br>

                                <hr>

                        @endforeach
                        @else
                        <p>Oops! Looks like your profile is not set up yet. Please fill out the details below</p>
                        <div>
                            <div class="card-body">
                                <form method="POST" action="/addProfile/{{Auth::user()->id}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                        <div class="col-md-6">
                                            <input id="date_of_birth" type="text" class="form-control rounded-pill @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" autofocus placeholder="YYYY-MM-DD">

                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                        <div class="col-md-6">
                                            <input id="gender" type="gender" class="form-control rounded-pill @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" placeholder="Male/Female/Other">

                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="quote" class="col-md-4 col-form-label text-md-right">{{ __('An Inspiring Quote') }}</label>

                                        <div class="col-md-6">
                                            <input id="quote" type="quote" class="form-control rounded-pill @error('quote') is-invalid @enderror" name="quote" required autocomplete="quote" placeholder="Do one thing every day that scares you.">

                                            @error('quote')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="profile_pic" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>

                                        <div class="col-md-6">
                                            <input id="profile_pic" type="file" class="form-control rounded-pill" name="profile_pic" required autocomplete="profile_pic">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary rounded-pill">
                                                {{ __('Create Profile') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        <h3>Recent Tweets </h3>
                        <hr>
                        @if (count($tweets)>0)
                                @foreach ($tweets as $tweet)
                                    @php
                                        $likeCount = count(\App\Tweet::find($tweet->id)->like);

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


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection




