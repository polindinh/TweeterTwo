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
                            <h3>Welcome {{Auth::user()->name}}</h3>
                            <hr>
                            <div class="form-group shadow-textarea">
                                <form action="/tweets/addTweet" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                    <input id="field" class="form-control form-control-lg"  rows="4" cols="93" type="text" name="content" value="{{old('content')}}" placeholder="What's on your mind?" ></input>
                                    <input class="btn btn-primary" type="submit" name="submit" value="Create Tweet" style="margin: 10px 0; float:right ">
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
                            {{-- @php

                            function checkFollow($userToCheck, $follows) {
                                foreach ($follows as $follow) {
                                    if($follow->followed == $userToCheck) {
                                        return true;
                                    }
                                }
                                return false;
                            }

                            @endphp --}}
                            <h3>Recent Tweets</h3>
                            <hr>
                            @if (count($tweets)>0)
                                @foreach ($tweets as $tweet)
                                    @php
                                        $likeCount = count(\App\Tweet::find($tweet->id)->like);
                                        $dislikeCount = count(\App\Tweet::find($tweet->id)->dislike);

                                    @endphp
                                    @if ($tweet-> user_id == Auth::user()->id)
                                    <a href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet-> user->name}}</strong></p></a>
                                    <p>{{substr($tweet-> content,0,150)}}</p>
                                        <p><i>Posted on: {{$tweet-> created_at}}</i></p>
                                        <p><i>Updated on: {{$tweet-> updated_at}}</i></p>

                                        @include('navbarUser')
                                        <br>
                                        <hr>
                                    @else
                                        <a href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet-> user->name}}</strong></p></a>
                                        {{-- @foreach ($users as $user)
                                            <p>{{$user->name}}</p>
                                            @if (checkFollow($user->name, $follows))
                                                <div class="form-group shadow-textarea">
                                                    <form action="/unfollow/{{$user->id}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                                        <input class="btn btn-primary" type="submit" name="submit" value="Unfollow" style="margin: 15px 0;">
                                                    </form>
                                                </div>
                                            @else
                                                <div class="form-group shadow-textarea">
                                                    <form action="/follow/{{$user->id}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                                        <input class="btn btn-primary" type="submit" name="submit" value="Follow" style="margin: 15px 0;">
                                                    </form>
                                                </div>
                                            @endif
                                        @endforeach --}}
                                        <p>{{substr($tweet-> content,0,150)}}</p>
                                        <p><i>Posted on: {{$tweet-> created_at}}</i></p>
                                        <p><i>Updated on: {{$tweet-> updated_at}}</i></p>

                                        @include('navbarGuest')
                                        <hr>
                                    @endif
                                @endforeach
                            @else
                                <p>No tweet found!</p>
                            @endif
                        @endguest

                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
@endsection
