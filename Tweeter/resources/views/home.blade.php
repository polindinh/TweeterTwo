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
                            <h2>Welcome {{Auth::user()->name}}</h2>
                            <hr>
                            <div class="form-group shadow-textarea">
                                <form action="/tweets/addTweet" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                    <textarea class="form-control z-depth-1"  rows="4" cols="93" type="text" name="content" placeholder="What's on your mind?" ></textarea>
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
                            <h3>Recent Tweets</h3>
                            <hr>
                            @if (count($tweets)>0)
                                @foreach ($tweets as $tweet)
                                    @php
                                        $likeCount = count(\App\Tweet::find($tweet->id)->like);
                                    @endphp
                                    @if ($tweet-> user_id == Auth::user()->id)

                                        <p><strong>{{$tweet-> user->name}}</strong></p>
                                        <p>{{substr($tweet-> content,0,150)}}</p>
                                        <p><i>Posted on: {{$tweet-> created_at}}</i></p>
                                        <p><i>Updated on: {{$tweet-> updated_at}}</i></p>

                                        @include('navbarUser')
                                        <br>
                                        <hr>
                                    @else
                                        <p><strong>{{$tweet-> user->name}}</strong></p>
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
