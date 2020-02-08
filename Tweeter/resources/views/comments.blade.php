@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comment Tweet</div>
                    <div class="card-body">
                        @include('flashMessage')
                        <div>
                            {{-- @foreach ($tweets as $tweet) --}}
                            <strong><p>{{$tweets-> user ->name}}</p></strong>
                            <p>{{$tweets-> content}}</p>
                            <div class="form-group shadow-textarea">
                                <form action="/commentPost/{{$tweets->id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                    <input type="hidden" name="tweet_id" value={{$tweets->id}} >
                                    <textarea class="form-control z-depth-1"  rows="4" cols="93" type="text" name="content" placeholder="What are your thoughts?"></textarea>
                                    <input class="btn btn-primary" type="submit" name="submit"  style="margin: 15px 0; float:right">
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

                            @if ($tweets-> user_id == Auth::user()->id)
                                @php
                                    $likeCount = count(\App\Tweet::find($tweets->id)->like);
                                    $dislikeCount = count(\App\Tweet::find($tweets->id)->dislike);

                                @endphp
                                @include('navbarsUser')
                            @else
                                @php
                                    $likeCount = count(\App\Tweet::find($tweets->id)->like);
                                    $dislikeCount = count(\App\Tweet::find($tweets->id)->dislike);

                                 @endphp
                                @include('navbarsGuest')

                            @endif
                            <hr>
                            <hr>
                            <h1>Comments Section</h1>
                            <hr>
                                <hr>

                            {{-- @endforeach --}}
                            @if (count($comments)>0)
                                @foreach ($comments as $comment)
                                    @if ($comment-> user_id == Auth::user()->id)
                                        <p><strong>{{$comment-> user->name}}</strong></p>
                                        <p>{{$comment-> content}}</p>
                                        {{-- <p>{{$comment-> id}}</p> --}}

                                        <p><i>Commented on: {{$comment-> created_at}}</i></p>
                                        {{-- <p><i>Updated on: {{$comment-> updated_at}}</i></p> --}}

                                        @include('navbarCommentUser')
                                        <br>
                                        <hr>
                                    @else
                                        <p><strong>{{$comment-> user->name}}</strong></p>
                                        <p>{{$comment-> content}}</p>
                                        <p><i>Commented on: {{$comment-> created_at}}</i></p>
                                        {{-- <p><i>Updated on: {{$comment-> updated_at}}</i></p> --}}

                                        @include('navbarCommentGuest')
                                        <hr>
                                    @endif
                                @endforeach
                            @else
                                <br>
                                <h3>No Comments found!</h3>
                            @endif




                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
