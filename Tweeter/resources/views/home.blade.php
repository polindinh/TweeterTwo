@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <strong>Your Profile</strong>
                </div>
                <div class="card-body">
                    @php
                        $profileI = \App\User::find(Auth::user()->id)->profile;
                        $followingCount = count(\App\Follow::where('user_id','=', Auth::user()->id)->get());
                        $followersCount = count(\App\Follow::where('followed','=', Auth::user()->id)->get());
                    @endphp
                    @isset($profileI)
                        <img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/'.$profileI->profile_pic)}}" style="border-radius:50%;height:75px;width:75px;" alt="Image">
                        <br>
                        <a href="/profile/{{Auth::user()->id}}"><h2 class = "text-center">{{Auth::user()->name}}</h2></a>
                        <b>Gender :</b> {{$profileI->gender}} <br>
                        <b>Date of Birth : </b>{{$profileI->date_of_birth}}<br>
                        <b>Inspiring Quote : </b>{{$profileI->quote}}<br>
                        <b>Member Since :</b> {{date("jS F, Y",strtotime($profileI->created_at))}}
                        <hr>
                        <div>
                            <span style="color:#1DA1F2">Following ({{$followingCount}}) </span>
                            <span style="color:#1DA1F2">Followers ({{$followersCount}}) </span>
                        </div>
                        <br>

                    @endisset
                    @empty($profileI)

                    <p>Oops! Looks like your profile is not set up yet. Please fill out the details below</p>
                        <div>
                            <div class="card-body">
                                <form method="POST" action="/addProfile/{{Auth::user()->id}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="date_of_birth" class="col-md-12 col-form-label text-md-center">{{ __('Date of Birth') }}</label>

                                        <div class="col-md-12">
                                            <input id="date_of_birth" type="text" class="form-control rounded-pill text-md-center @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" autofocus placeholder="YYYY-MM-DD">

                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="col-md-12 col-form-label text-md-center">{{ __('Gender') }}</label>

                                        <div class="col-md-12">
                                            <input id="gender" type="gender" class="form-control rounded-pill text-md-center @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" placeholder="Male/Female/Other">

                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="quote" class="col-md-12 col-form-label text-md-center">{{ __('An Inspiring Quote') }}</label>

                                        <div class="col-md-12">
                                            <input id="quote" type="quote" class="form-control rounded-pill text-md-center  @error('quote') is-invalid @enderror" name="quote" required autocomplete="quote" placeholder="Do one thing every day that scares you.">

                                            @error('quote')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="profile_pic" class="col-md-12 col-form-label text-md-center">{{ __('Profile Image') }}</label>

                                        <div class="col-md-12">
                                            <input id="profile_pic" type="file" class="form-control rounded-pill text-md-center" name="profile_pic" required autocomplete="profile_pic">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12 text-md-center">
                                            <button type="submit" class="btn btn-primary rounded-pill">
                                                {{ __('Create Profile') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endempty

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Home</strong>
                </div>
                <div class="card-body">
                    @include('flashMessage')
                    @guest
                        <div class="row justify-content-center">
                            <p>You are not authorized to access this page. Please login or register</p>
                        </div>
                    @else
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
                        <div class="form-group shadow-textarea">
                            <form action="/tweets/addTweet" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                <input id="field" class="form-control form-control-lg rounded-pill border border-primary"  rows="4" cols="93" type="text" name="content" value="{{old('content')}}" placeholder="What's on your mind?" ></input>
                                <input class="btn btn-primary rounded-pill border border-primary" type="submit" name="submit" value="Tweet" style="margin: 10px 0; float:right ">
                            </form>
                        </div>
                        @if($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color:red">{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h3>Recent Tweets</h3>
                        <hr>
                        @if (count($tweets)>0)
                            @foreach ($tweets as $tweet)
                                @php
                                    $likeCount = count(\App\Tweet::find($tweet->id)->like);
                                    $commentCount = count(\App\Tweet::find($tweet->id)->comment);
                                    $profileImage = \App\User::find($tweet->user_id)->profile;
                                    // $dislikeCount = count(\App\Tweet::find($tweet->id)->dislike);
                                @endphp
                                @if ($tweet-> user_id == Auth::user()->id)
                                @isset($profileImage)
                                <img class="img-fluid" src="{{asset('/storage/'.$profileImage->profile_pic)}}" style="border-radius:50%;height:75px;width:75px;" alt="Image">

                                <br><br>
                                <a href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet-> user->name}}</strong></p></a>
                                <p>{{substr($tweet-> content,0,150)}}</p>
                                    <p class = "time"><i>Posted: {{$tweet-> created_at->diffForHumans()}}</i></p>
                                    <p class = "time"><i>Updated: {{$tweet-> updated_at->diffForHumans()}}</i></p>

                                    @include('navbarUser')
                                    <br>


                                    @if (checkLike($tweet->id, Auth::user()->like))
                                            {{-- <p>Already Following</p> --}}
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
                                            @endisset
                                        @endif
                                @empty( $profileImage)
                            
                                <img class="img-fluid" src="{{asset('/storage/profile_images/noimage.jpg/')}}" style="border-radius:50%;height:75px;width:75px;" alt="Image">
                                <a href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet-> user->name}}</strong></p></a>
                                <p>{{substr($tweet-> content,0,150)}}</p>
                                    <p class = "time"><i>Posted: {{$tweet-> created_at->diffForHumans()}}</i></p>
                                    <p class = "time"><i>Updated: {{$tweet-> updated_at->diffForHumans()}}</i></p>

                                    @include('navbarUser')
                                    <br>


                                    @if (checkLike($tweet->id, Auth::user()->like))
                                            {{-- <p>Already Following</p> --}}
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
                                @endempty


                                    <br>
                                    <hr>
                                @else
                                    <img class="img-fluid" src="{{asset('/storage/'.$profileImage->profile_pic)}}" style="border-radius:50%;height:75px;width:75px;" alt="Image">
                                    <br><br>
                                    <a href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet-> user->name}}</strong></p></a>
                                    <p>{{substr($tweet-> content,0,150)}}</p>
                                    <p class = "time"><i>Posted: {{$tweet-> created_at->diffForHumans()}}</i></p>
                                    <p class = "time"><i>Updated: {{$tweet-> updated_at->diffForHumans()}}</i></p>

                                    @include('navbarGuest')
                                    <br>
                                    @if (checkLike($tweet->id, Auth::user()->like))
                                    {{-- <p>Already Following</p> --}}
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
                    @endguest



                </div>
                {{ $tweets->links() }}

            </div>

        </div>



        <div class="col-md-3  " >
            <div class="card ">
                <div class="card-header">
                    <div class="form-group shadow-textarea">

                        <form action="{{route('search')}}" method="get" class="navbar-nav ml-auto">
                            @csrf
                            <input type="text" name="search" class="form-control rounded-pill border border-primary m-1" placeholder="Search users...">
                            <button class="btn btn-primary rounded-pill m-1 "  type="submit">Go</button>

                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="text-center">Trending Users</h2>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection






