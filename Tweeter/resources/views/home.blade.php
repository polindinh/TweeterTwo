@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>
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

                            <h3>Welcome {{Auth::user()->name}}</h3>
                            <hr>
                            <div class="form-group shadow-textarea">
                                <form action="/tweets/addTweet" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                    <input id="field" class="form-control form-control-lg"  rows="4" cols="93" type="text" name="content" value="{{old('content')}}" placeholder="What's on your mind?" ></input>
                                    <input class="btn btn-primary rounded-pill" type="submit" name="submit" value="Create Tweet" style="margin: 10px 0; float:right ">
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
                        {{ $tweets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection






